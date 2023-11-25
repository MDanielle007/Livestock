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

            <v-btn icon @click="NotificationIconClick" color="white" style="margin-right: 2px;">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512" style="fill: white">
                  <path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/>
                </svg>
              </v-btn>

            <v-btn icon @click="UserProfileClick">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 448 512" style="fill: white ">
                  <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                </svg>
              </v-btn>
        
        </template>
      </v-app-bar>
</template>
<script>
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
    }
}
</script>
<style>
    
</style>