<template>
    <el-container>
        <el-form :model="form" label-position="top" class="login-form" status-icon @submit.prevent="authorize">
            <el-form-item label="Email" prop="email" :error="errors.email.join(',')">
                <el-input v-model="form.email"/>
            </el-form-item>
            <el-form-item label="Password" prop="password" :error="errors.password.join(',')">
                <el-input v-model="form.password" type="password"/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" :loading="loading" :disabled="loading"
                           native-type="submit">
                    Login
                </el-button>
            </el-form-item>
        </el-form>
    </el-container>
</template>

<script setup>
import {ref} from 'vue'
import axios from "axios";

const form = ref({
    email: '',
    password: ''
})

const errors = ref({
    email: [],
    password: []
})

const loading = ref(false)

const authorize = () => {
    errors.value = Object.assign({}, {
        email: [],
        password: []
    })

    axios.post('/login', form.value)
        .then((res) => {
            window.location = res.data.route;
        })
        .catch((error) => {
            errors.value = Object.assign({
                email: [],
                password: []
            }, error.response.data.errors)
        })
}
</script>

<style scoped lang="scss">
.el-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.login-form {
    min-width: 450px;
}
</style>
