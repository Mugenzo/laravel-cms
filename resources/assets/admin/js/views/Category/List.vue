<template>
    <el-row justify="space-between" align="middle">
        <el-col :span="12" class="flex gap-15 align-center">
            <h3>Categories</h3>
            <el-button type="primary" @click.prevent="createDrawer = true">Add new</el-button>
        </el-col>
        <el-col :span="12" class="flex justify-right">
            <el-pagination
                v-model:current-page="currentPage"
                v-model:page-size="pageSize"
                :page-sizes="[20, 50, 100, 200, 300, 400]"
                layout="total, sizes, prev, pager, next, jumper"
                :total="total"
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
            />
        </el-col>
    </el-row>
    <el-table :data="records" style="width: 100%" stripe>
        <el-table-column prop="title" label="Title" width="180"/>
        <el-table-column prop="slug" label="Slug" width="180"/>
        <el-table-column prop="description" label="Description"/>
        <el-table-column prop="actions" label="Actions" width="250" align="right">
            <template #header>
                <el-input v-model="search" size="small" placeholder="Type to search"/>
            </template>
            <template #default="scope">
                <el-button size="small">
                    Edit
                </el-button>
                <el-button size="small" type="danger">
                    Delete
                </el-button>
            </template>
        </el-table-column>
    </el-table>

    <el-drawer
        v-model="createDrawer"
        title="Create category"
        :before-close="handleCreateClose"
        :destroy-on-close="true"
        size="50%"
    >
        <create @close="createDrawer = false"/>
    </el-drawer>
</template>

<script setup>
import {ref, onMounted} from "vue";
import $axios from '../../plugins/axios'
import Create from "./Create.vue";

const search = ref("")

const records = ref([])
const currentPage = ref(1);
const pageSize = ref(20)
const total = ref(0)

const handleSizeChange = () => {
}
const handleCurrentChange = () => {
}

const getRecords = () => {
    $axios.get(`/categories?page=${currentPage.value}&per-page=${pageSize.value}`)
        .then((res) => {
            records.value = res.data.data;
            total.value = res.data.meta.total;
        })
}

onMounted(() => {
    getRecords();
})

const createDrawer = ref(false)
const handleCreateClose = (done) => {
    ElMessageBox.confirm('Are you sure you want to close this?')
        .then(() => {
            done()
        })
}
</script>

<style scoped>

</style>
