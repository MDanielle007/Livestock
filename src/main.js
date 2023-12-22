import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import axios from 'axios'
import bottomNavigationVue from "bottom-navigation-vue";
import "bottom-navigation-vue/dist/style.css";
import '@/assets/sass/variables.scss'
import store from './store'

axios.defaults.baseURL = 'https://orminlivestock.online/orminlivestock/'
// axios.defaults.baseURL = 'http://livestockbackend.test/'
// loadFonts()

createApp(App)
  .use(router)
  .use(vuetify)
  .use(store)
  .use(bottomNavigationVue)
  .mount('#app')
