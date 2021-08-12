import {createApp} from 'vue'

require('./bootstrap')
import App from './App.vue'
import axios from 'axios'
import router from './router'
import store from "./store"
import Toaster from '@meforma/vue-toaster';

const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.use(router)
app.use(Toaster, {position: "top-right"})
app.use(store)
app.mount('#app')
