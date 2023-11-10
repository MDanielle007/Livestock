<template>
    <v-app-bar
        color="teal-darken-4"
        image="https://picsum.photos/1920/1080?random"
    >
        <template v-slot:image>
            <v-img
                gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)"
            ></v-img>
        </template>

        <v-app-bar-title>Livestock Outlook</v-app-bar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
            <v-icon>mdi-magnify</v-icon>
        </v-btn>

        <v-btn icon>
            <v-icon>mdi-heart</v-icon>
        </v-btn>

        <v-btn icon>
            <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
    </v-app-bar>
</template>
<script>
export default {
    name: 'FarmerAppbar',
}
</script>
<style>
    
</style>