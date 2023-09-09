import { createApp } from 'vue'
import { createRouter, createWebHashHistory } from "vue-router";
import routes from './router';
import App from './views/App.vue'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { registerComponents } from './views/components';

const vuetify = createVuetify({
    components,
    directives,
})

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

const app = createApp(App)
    .use(vuetify)
    .use(router);

registerComponents(app);

app.mount('#app')