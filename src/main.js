import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import axios from 'axios'
import './index.css'
import { initFlowbite } from 'flowbite'

axios.defaults.baseURL = 'http://livestockbackend.test/'

createApp(App).use(router).use(initFlowbite).mount('#app')
