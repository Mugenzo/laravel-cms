const routes = [
    {
        path: '/posts',
        component: () => import("@adminJs/views/pages/Post/Index.vue"),
        children: [
            {
                path: '',
                name: 'posts',
                component: () => import("@adminJs/views/pages/Post/List.vue")
            },
            {
                path: 'create',
                component: () => import("@adminJs/views/pages/Post/Create.vue")
            },
            {
                path: ':id',
                component: () => import("@adminJs/views/pages/Post/Update.vue")
            },
        ]
    },
    {
        path: '/categories',
        component: () => import("@adminJs/views/pages/Category/Index.vue"),
        children: [
            {
                name: 'categories',
                path: '',
                component: () => import("@adminJs/views/pages/Category/List.vue")
            },
            {
                path: 'create',
                component: () => import("@adminJs/views/pages/Category/Create.vue")
            },
            {
                path: ':id',
                component: () => import("@adminJs/views/pages/Category/Update.vue")
            },
        ]
    },
]

export default routes
