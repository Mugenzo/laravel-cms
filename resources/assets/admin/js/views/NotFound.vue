<template>
    <div class="404">
        <h2>This page doesn't exists</h2>

        <router-link custom to="/" v-slot="{ navigate, href, route }">
            <el-link :href="href" @click="navigate">To dashboard</el-link>
        </router-link>
    </div>
</template>
<script setup>
document.title = "Page not found";
</script>
<style scoped>

</style>
