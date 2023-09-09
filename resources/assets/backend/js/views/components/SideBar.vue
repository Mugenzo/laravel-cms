<script>
</script>
<template>
    <v-navigation-drawer>
        <v-list :lines="false" density="compact" :nav="true">
            <v-list-item color="primary" :to="{name: 'posts'}">
                <v-list-item-title>Posts</v-list-item-title>
            </v-list-item>
            <v-list-item color="primary" :to="{name: 'categories'}" :link="true">
                <v-list-item-title>Categories</v-list-item-title>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
