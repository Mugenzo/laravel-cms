<template>
    <el-row justify="space-between" align="middle">
        <el-col :span="12" class="flex gap-15 align-center">
            <h3>Media</h3>
            <el-button @click="uploadComponentDialog = true" type="primary">
                Upload
            </el-button>
        </el-col>
        <el-col :span="12" class="flex justify-right">
            <el-pagination v-model:current-page="currentPage" v-model:page-size="pageSize"
                           :page-sizes="[32, 64, 128, 256]"
                           layout="total, sizes, prev, pager, next, jumper" :total="total"
                           @size-change="handleSizeChange"
                           @current-change="handleCurrentChange"/>
        </el-col>
    </el-row>
    <div class="media-grid">
        <el-card class="media-img-preview" v-for="({ id, file_url, title, alt }) in records" :key="`media_${id}`">
            <el-image :src="file_url" :alt="alt" :title="title" style="width: 100%; height: 100%" fit="cover"
                      loading="eager">
                <template #placeholder>
                    <div class="preloader">
                        <el-icon>
                            <Loading/>
                        </el-icon>
                    </div>
                </template>
            </el-image>
            <div class="action-buttons">
                <template v-if="select">
                    <el-button :icon="Check" circle type="primary" @click="emitSelected({ id, file_url })"/>
                </template>
                <template v-else>
                    <el-button :icon="Edit" circle type="primary"/>
                    <el-button :icon="Delete" circle type="danger"/>
                </template>
            </div>
        </el-card>
    </div>
    <el-dialog v-model="uploadComponentDialog">
        <UploadComponent v-on:uploaded="loadOnUploaded()"/>
    </el-dialog>
</template>

<script setup lang="ts">
import {ref, onMounted} from "vue";
import {Loading, Check, Edit, Delete} from '@element-plus/icons-vue'
import UploadComponent from "./Partials/UploadComponent.vue";
import $axios from "@/admin/js/plugins/axios";

defineProps({
    select: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['selected'])

const uploadComponentDialog = ref<boolean>(false)

const records = ref([])
const currentPage = ref<number>(1);
const pageSize = ref<number>(32)
const total = ref<number>(0)

onMounted(() => {
    getRecords()
})

const handleSizeChange = (size: number) => {
    pageSize.value = size;
    getRecords();
}
const handleCurrentChange = (page: number) => {
    currentPage.value = page;
    getRecords();
}

const getRecords = () => {
    $axios.get(`/media?page=${currentPage.value}&per-page=${pageSize.value}`)
        .then((res) => {
            records.value = res.data.data;
            total.value = res.data.meta.total;
        })
        .catch((error) => {
            console.error(error)
        })
}

const loadOnUploaded = () => {
    uploadComponentDialog.value = false;
    getRecords()
}

const emitSelected = (file) => {
    emit('selected', file)
}
</script>

<style scoped lang="scss">
.media {
    &-grid {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 20px;

        .img-preview {
            aspect-ratio: 1 / 1;

            .el-card__body {
                padding: 0;
            }

            img {
                width: 100%;
                object-fit: cover;
            }
        }
    }
}
</style>
