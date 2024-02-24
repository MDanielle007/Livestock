<template>
    <div class="grid">
        <div class="col-12">
            <LivestockSmallCard :icon="'pi pi-heart-fill'" :iconColor="'text-red-300'"  :title="'Pregnant Livestocks'" :value="12"/>
        </div>
        <div class="col-12">
            <LivestockBreedingDataView/>
        </div>
    </div>
</template>
<script>
import LivestockSmallCard from '@/components/general/LivestockSmallCard.vue';
import LivestockBreedingDataView from '@/components/general/dataviews/LivestockBreedingDataView.vue';

export default {
    components:{
        LivestockBreedingDataView,
        LivestockSmallCard
    }   
}
</script>
<style>
    
</style>