<template>
    <div>
        <h1>Farmer</h1>
        <FarmerBottomNav/>
        <router-view></router-view>
    </div>
</template>
<script>
import FarmerBottomNav from '@/components/farmer/FarmerBottomNav.vue';
export default {
    name:'FarmerLayout',
    components:{
        FarmerBottomNav
    }
}
</script>
<style>
    
</style>