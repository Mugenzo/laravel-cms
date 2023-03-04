<template>
    <el-form :model="form" label-position="top" :label-width="formLabelWidth">
        <el-row>
            <el-col :span="17">
                <el-form-item label="Title">
                    <el-input v-model="form.title" autocomplete="off"/>
                </el-form-item>
                <el-form-item label="Slug">
                    <el-input v-model="form.slug" autocomplete="off"/>
                </el-form-item>
            </el-col>
            <el-col :span="7"></el-col>
        </el-row>

        <el-form-item label="Description">
            <el-input v-model="form.description" type="textarea" rows="12"/>
        </el-form-item>
        <el-form-item>
            <el-button @click="cancelForm">Cancel</el-button>
            <el-button type="primary" :loading="loading" @click="store">{{
                    loading ? 'Creating ...' : 'Create'
                }}
            </el-button>
        </el-form-item>
    </el-form>
</template>

<script setup>
import {ref, defineEmits} from "vue";
import $axios from "../../plugins/axios";

const emit = defineEmits(['close', 'getRecords'])

const formLabelWidth = 120;
const form = ref({
    title: '',
    slug: '',
    description: ''
})
const loading = ref(false)
const cancelForm = () => {
    emit('close')
}

const store = () => {
    $axios.post('/categories', form.value)
        .then((res) => {
            emit('getRecords')
        })
}
</script>

<style scoped>

</style>
