<template>
    <v-layout class="h-100">
        <FarmerAppbar/>
        <FarmerBottomNav/>
        <v-main>
            <h1>Farmer Portal</h1>
            <router-view></router-view>
        </v-main>
    </v-layout>
</template>
<script>
import { defineComponent } from 'vue';

// components
import FarmerAppbar from '../../../components/farmer/FarmerAppbar.vue';
import FarmerBottomNav from '../../../components/farmer/FarmerBottomNav.vue';

export default defineComponent({
    name: 'Farmer Portal',
    components: {
        FarmerAppbar,
        FarmerBottomNav
    }
})
</script>
<style>
    
</style>