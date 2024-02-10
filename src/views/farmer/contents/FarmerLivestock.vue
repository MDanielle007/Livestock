<template>
    <FarmerLivestockTabMenu />
    <div class="bg-white p-3 border-round-bottom-lg">
        <router-view></router-view>
    </div>
</template>
<script>
import FarmerLivestockTabMenu from "@/components/farmer/FarmerLivestockTabMenu.vue";
export default {
    components: {
        FarmerLivestockTabMenu,
    },
};
</script>
<style></style>
