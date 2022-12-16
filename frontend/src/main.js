import * as Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueCookies from 'vue3-cookies'
import './index.css'

Vue.createApp(App).use(router).use(store).use(VueCookies, {
    expireTimes: "10d",
        path: "/",
        domain: "",
        secure: true,
        sameSite: "None"
}).mount('#app')
