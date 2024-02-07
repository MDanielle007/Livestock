<template>
    <div class="surface-100 flex flex-column min-w-screen min-h-screen">
        <div class="absolute">
            <FarmerTopBar />
        </div>
        <main class="mt-8">
            <router-view></router-view>
        </main>
        
    </div>
    <FarmerDockNavigation/>
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