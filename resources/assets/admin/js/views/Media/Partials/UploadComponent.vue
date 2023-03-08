<template>
    <el-upload drag multiple class="upload-demo" action="/api/media" method="post" :with-credentials="true"
        :headers="headers" :on-success="successUpload" :on-error="errorUpload" :accept="accepts">
        <el-icon class="el-icon--upload">
            <upload-filled />
        </el-icon>
        <div class="el-upload__text">
            Drop file here or <em>click to upload</em>
        </div>
        <template #tip>
            <div class="el-upload__tip">
                jpg/png files with a size less than 500kb
            </div>
        </template>
    </el-upload>
</template>

<script setup lang="ts">
import { UploadFilled } from '@element-plus/icons-vue'
import { ElNotification } from 'element-plus'

const emits = defineEmits(['uploaded'])

const accepts = import.meta.env.CMS_UPLOAD_TYPES;

const headers = {
    'Accept': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
}

const successUpload = (res) => {
    ElNotification({
        title: 'Success',
        message: res.message,
        type: 'success',
    });
    emits('uploaded')
}
const errorUpload = (error) => {
    console.error(error)
    ElNotification({
        title: 'Error',
        message: "Error while processing data",
        type: 'error',
    });
}
</script>

<script lang="ts">
export default {
}
</script>

<style scoped></style>
