import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import axios from 'axios'
import bottomNavigationVue from "bottom-navigation-vue";
import "bottom-navigation-vue/dist/style.css";


axios.defaults.baseURL = 'http://livestockbackend.test/'
loadFonts()

createApp(App)
  .use(router)
  .use(vuetify)
  .use(bottomNavigationVue)
  .mount('#app')
