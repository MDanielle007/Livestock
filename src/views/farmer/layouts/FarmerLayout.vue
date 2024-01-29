<template>
    <div class="flex flex-column min-w-screen min-h-screen">
        <main class="bg-blue-300 min-h-screen flex flex-column justify-content-center align-items-center">
            <router-view></router-view>
        </main>
        <FarmerDockNavigation/>
    </div>
</template>
<script>
import { RouterView } from 'vue-router';
import FarmerDockNavigation from '@/components/farmer/FarmerDockNavigation.vue';
export default {
    components:{
        RouterView,
        FarmerDockNavigation,
    }
}
</script>
<style>
    
</style>