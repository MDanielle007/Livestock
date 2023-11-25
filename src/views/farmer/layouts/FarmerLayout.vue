<template>
    <v-layout class="h-100" style="background-color: #F6F6F6;">
        <FarmerAppbar/>
        <FarmerBottomNav/>
        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
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