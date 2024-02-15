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

// axios.defaults.baseURL = 'https://orminlivestock.online/orminlivestock/'
axios.defaults.baseURL = 'https://livestockbackend.test/'
// loadFonts()
// Register the service worker
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/firebase-messaging-sw.js')
      .then((registration) => {
        console.log('Service Worker registered:', registration);
      })
      .catch((error) => {
        console.error('Service Worker registration failed:', error);
      });
  });
}

createApp(App)
  .use(router)
  .use(vuetify)
  .use(store)
  .use(bottomNavigationVue)
  .mount('#app')
