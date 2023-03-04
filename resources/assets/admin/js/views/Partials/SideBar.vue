<template>
    <el-menu :router="true">
        <el-menu-item index="users">
            <el-icon>
                <icon-menu/>
            </el-icon>
            <span>Users</span>
        </el-menu-item>
        <el-menu-item index="posts">
            <el-icon>
                <document/>
            </el-icon>
            <span>Posts</span>
        </el-menu-item>
        <el-menu-item index="categories">
            <el-icon>
                <setting/>
            </el-icon>
            <span>Categories</span>
        </el-menu-item>
        <el-menu-item index="tags">
            <el-icon>
                <setting/>
            </el-icon>
            <span>Tags</span>
        </el-menu-item>
    </el-menu>
</template>

<script lang="ts" setup>
import {
    Document,
    Menu as IconMenu,
    Location,
    Setting,
} from '@element-plus/icons-vue'
</script>

<style scoped>
.el-menu {
    min-height: 100vh;
    height: 100%;
}
</style>
