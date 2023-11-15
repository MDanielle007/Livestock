<template>
    <v-app-bar theme="light" :elevation="1">
        <v-app-bar-nav-icon variant="text" @click.stop="IconClicked" ></v-app-bar-nav-icon>
        <template v-slot:append>
          <v-btn icon="mdi:mdi-heart"></v-btn>
    
          <v-btn icon="mdi:mdi-magnify"></v-btn>
    
          <v-btn icon="mdi:mdi-dots-vertical"></v-btn>
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