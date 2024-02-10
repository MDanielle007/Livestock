<template>
    <div class="surface-100 flex flex-column min-h-screen">
        <div class="absolute">
            <FarmerTopBar />
        </div>
        <main class="bg-blue-300 farmer-content-container my-8 overflow-y-auto p-3">
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