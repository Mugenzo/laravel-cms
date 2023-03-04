import {createApp} from 'vue'
import ElementPlus from 'element-plus'
import LoginPage from './LoginPage.vue'


const app = createApp(LoginPage);
app.use(ElementPlus)
app.mount('#app')
