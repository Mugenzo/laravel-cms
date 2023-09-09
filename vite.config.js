import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/admin/js/app.js',
                'resources/assets/admin/scss/style.scss',
                'resources/assets/auth/js/app.js',
                'resources/assets/auth/scss/style.scss',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/assets',
            '@adminJs': '/resources/assets/backend/js'
        },
    },
});
