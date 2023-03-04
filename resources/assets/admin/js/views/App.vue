<template>
    <el-container>
        <el-aside width="200px">
            <side-bar />
        </el-aside>
        <el-main>
            <router-view/>
        </el-main>
    </el-container>
</template>

<script setup>
import axios from 'axios'
import SideBar from "./Partials/SideBar.vue";

</script>

<style scoped>

</style>
