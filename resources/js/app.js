import {createApp} from 'vue'

require('./bootstrap')
import App from './App.vue'
import axios from 'axios'
import router from './router'
import store from "./store"
import Toaster from '@meforma/vue-toaster';

axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if (error.response.status === 401) {
        store.commit('setUser', null)
        router.push('/login')
    }
    return Promise.reject(error)
})


const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.use(router)
app.use(Toaster, {position: "top-right"})
app.use(store)
app.mount('#app')
