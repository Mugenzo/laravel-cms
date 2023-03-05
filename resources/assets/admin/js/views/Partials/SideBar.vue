<template>
    <el-menu :router="true">
        <el-menu-item index="users">
            <el-icon>
                <User/>
            </el-icon>
            <span>Users</span>
        </el-menu-item>
        <el-menu-item index="media">
            <el-icon>
                <Picture/>
            </el-icon>
            <span>Media</span>
        </el-menu-item>
        <el-menu-item index="posts">
            <el-icon>
                <Document/>
            </el-icon>
            <span>Posts</span>
        </el-menu-item>
        <el-menu-item index="categories">
            <el-icon>
                <Collection/>
            </el-icon>
            <span>Categories</span>
        </el-menu-item>
        <el-menu-item index="tags">
            <el-icon>
                <CollectionTag/>
            </el-icon>
            <span>Tags</span>
        </el-menu-item>
    </el-menu>
</template>

<script lang="ts" setup>
import {
    User,
    Picture,
    Document,
    Collection,
    CollectionTag
} from '@element-plus/icons-vue'
</script>

<style scoped>
.el-menu {
    min-height: 100vh;
    height: 100%;
}
</style>
