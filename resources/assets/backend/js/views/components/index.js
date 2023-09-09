import Admin from '@adminJs/views/layouts/Admin.vue'
import Guest from '@adminJs/views/layouts/Guest.vue'

import SideBar from '@adminJs/views/components/SideBar.vue';

export const registerComponents = (app) => {
    app.component('admin', Admin);
    app.component('guest', Guest);
    app.component('side-bar', SideBar);
}