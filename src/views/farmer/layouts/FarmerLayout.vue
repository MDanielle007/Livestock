<template>
    <div class="flex flex-column min-w-screen min-h-screen">
        <div class="absolute">
            <FarmerTopBar />
        </div>
        <main class="min-h-screen flex flex-column justify-content-center align-items-center">
            <router-view></router-view>
        </main>
        <FarmerDockNavigation/>
    </div>
</template>
<script>
import { RouterView } from 'vue-router';
import FarmerTopBar from '@/components/farmer/FarmerTopBar.vue';
import FarmerDockNavigation from '@/components/farmer/FarmerDockNavigation.vue';
export default {
    components:{
        RouterView,
        FarmerTopBar,
        FarmerDockNavigation,
    }
}
</script>
<style>
    
</style>