import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: '/admin',
        children: [
            {
                name: 'dashboard',
                path: '/',
                component: () => import("../views/Dashboard.vue")
            },
            {
                path: '/users',
                component: () => import('../views/User/Index.vue'),
                children: [
                    {
                        name: 'users',
                        path: '',
                        component: () => import('../views/User/List.vue'),
                    }
                ]
            },
            {
                path: '/media',
                component: () => import('../views/Media/Index.vue'),
                children: [
                    {
                        name: 'media',
                        path: '',
                        component: () => import('../views/Media/List.vue'),
                    }
                ]
            },
            {
                path: '/posts',
                component: () => import('../views/Post/Index.vue'),
                children: [
                    {
                        name: 'posts',
                        path: '',
                        component: () => import('../views/Post/List.vue'),
                    }
                ]
            },
            {
                path: '/categories',
                component: () => import('../views/Category/Index.vue'),
                children: [
                    {
                        name: 'categories',
                        path: '',
                        component: () => import('../views/Category/List.vue'),
                    }
                ]
            },
            {
                path: '/tags',
                component: () => import('../views/Tag/Index.vue'),
                children: [
                    {
                        name: 'tags',
                        path: '',
                        component: () => import('../views/Tag/List.vue'),
                    }
                ]
            },
            {
                path: '/:pathMatch(.*)*',
                name: 'NotFound',
                component: () => import('../views/NotFound.vue')
            },
        ]
    }
];

const router = createRouter({
    history: createWebHistory('admin'),
    routes
})

export default router
