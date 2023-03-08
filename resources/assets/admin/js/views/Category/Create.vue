<template>
    <el-form :model="form" label-position="top" :label-width="formLabelWidth">
        <el-row>
            <el-col :span="17">
                <el-form-item label="Title">
                    <el-input v-model="form.title" autocomplete="off" required/>
                </el-form-item>
                <el-form-item label="Slug">
                    <el-input v-model="form.slug" autocomplete="off"/>
                </el-form-item>
            </el-col>
            <el-col :span="7">
                <SingleFileSelect :file="13" @selected="setMedia"/>
            </el-col>
        </el-row>

        <el-form-item label="Description">
            <el-input v-model="form.description" type="textarea" rows="12"/>
        </el-form-item>
        <el-form-item>
            <el-button @click="cancelForm">Cancel</el-button>
            <el-button type="primary" :loading="loading" @click="store">
                {{ loading ? 'Creating ...' : 'Create' }}
            </el-button>
        </el-form-item>
    </el-form>
</template>

<script setup>
import {ref} from "vue";
import $axios from "@/admin/js/plugins/axios";
import SingleFileSelect from "../Media/Partials/SingleFileSelect.vue";

const emit = defineEmits(['close', 'getRecords'])

const formLabelWidth = 120;
const form = ref({
    title: '',
    slug: '',
    description: '',
    media_id: null
})
const loading = ref(false)
const cancelForm = () => {
    emit('close')
}

const setMedia = (media_id) => {
    form.value.media_id = media_id
}

const store = () => {
    $axios.post('/categories', form.value)
        .then((res) => {
            emit('getRecords')
        })
}
</script>

<style scoped></style>
