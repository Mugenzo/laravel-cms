<template>
    <div class="el-form-item">
        <span class="el-form-item__label">Image</span>
        <div class="el-form-item__content">
            <el-image v-if="selectedFile" :src="selectedFile.file_url" style="width: 100%; height: 100%" fit="cover"
                      loading="eager">
                <template #placeholder>
                    <div class="preloader">
                        <el-icon>
                            <Loading/>
                        </el-icon>
                    </div>
                </template>
            </el-image>
            <el-button type="primary" @click="visible = true">Select</el-button>
        </div>
    </div>
    <el-dialog v-model="visible" title="Select image" width="calc(60vw)">
        <List :select="true" @selected="setSelected"/>
    </el-dialog>
</template>
<script setup lang="ts">
import {ref, onMounted} from 'vue'
import List from '../List.vue'
import $axios from "@/admin/js/plugins/axios";
import {Loading} from "@element-plus/icons-vue";

const props = defineProps<{
    file?: number
}>()

const visible = ref<boolean>(false)
const selectedFile = ref(null)
const emit = defineEmits(['selected'])

onMounted(() => {
    if (props.file) {
        $axios.get(`/media/${props.file}`)
            .then((res) => {
                selectedFile.value = res.data
            })
    }
})

const setSelected = (image) => {
    selectedFile.value = image;
    emit('selected', image.id)
}
</script>

<script lang="ts">
export default {}
</script>

<style scoped lang="scss">
.el-form-item {
    padding: 1px 11px;
}
</style>
