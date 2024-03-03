<template>
    <div class="grid">
        <div class="col-12">
            <router-link class="no-underline" :to="{name: 'FarmerLivestockPregnancy'}">
                <LivestockSmallCard :icon="'pi pi-heart-fill'" :iconColor="'text-red-300'"  :title="'Pregnant Livestocks'" :value="12"/>
            </router-link>
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