<template>
    <div class="grid">
        <div class="col-12">
            <LivestockSmallCard
                :icon="'pi pi-heart-fill'"
                :iconColor="'text-red-300'"
                :title="'Eggs Produced'"
                :value="12"
            />
        </div>
        <div class="col-12">
            <LivestockEggProductionDataView />
        </div>
    </div>
</template>
<script>
import LivestockSmallCard from '@/components/general/LivestockSmallCard.vue';
import LivestockEggProductionDataView from "@/components/general/dataviews/LivestockEggProductionDataView.vue";
export default {
    components: {
        LivestockEggProductionDataView,
        LivestockSmallCard
    },
};
</script>
<style></style>
