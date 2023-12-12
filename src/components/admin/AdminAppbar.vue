<template>
    <v-app-bar 
        theme="light" 
        :elevation="0"
        style="background: linear-gradient(to right, #0164a5, #142195, #142195, #0164a5)"
        prominent>
        <v-app-bar-nav-icon variant="text" @click.stop="IconClicked" ></v-app-bar-nav-icon>
        <template v-slot:append>
            
          <v-text-field
              v-model="search"
              prepend-inner-icon="mdi:mdi-magnify"
              density="compact"
              label="Search"
              single-line
              flat
              hide-details 
              variant="solo-filled" 
              
              style="width: 300px; height:20px; margin-right: 20px; margin-bottom: 20px; border-radius: 10px;">
          </v-text-field>

          <AdminNotificationMenu/>

            <v-btn icon :to="{name:'admin-profile'}">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512" style="fill: white ">
                  <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                </svg>
              </v-btn>
        
        </template>
      </v-app-bar>
</template>
<script>
import AdminNotificationMenu from './AdminNotificationMenu.vue'

export default {
    data: () => ({
        drawer: !null,
    }),
    methods:{
        IconClicked(){
            this.drawer = !this.drawer
            let isClose = this.drawer
            this.$emit('closeSidebar',isClose)
        }
    },
    components:{
      AdminNotificationMenu
    }
}
</script>
<style>
    
</style>