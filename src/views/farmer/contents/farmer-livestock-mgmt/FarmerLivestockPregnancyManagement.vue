<template>
    <div class="grid">
        <div class="col-12 flex justify-content-between">
            <router-link :to="{ name: 'FarmerLivestockBreedings' }">
                <Button icon="pi pi-chevron-left" />
            </router-link>  
        </div>
        <div class="col-12">
            <LivestockPregnancyDataView />
        </div>
    </div>
</template>
<script>
import LivestockSmallCard from "@/components/general/LivestockSmallCard.vue";
import LivestockPregnancyDataView from "@/components/general/dataviews/LivestockPregnancyDataView.vue";

export default {
    components: {
        LivestockPregnancyDataView,
        LivestockSmallCard,
    },
};
</script>
<style></style>
