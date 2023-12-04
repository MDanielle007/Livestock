<template>
    <v-sheet class="bg-transparent">
        <v-row>
            <v-col cols="12" >
                <AreaSpline :chartData="livestockBreedingRateData" :chartTitle="'Livestock Breeding Rate'" :height="280" seriesName="Breeding Rate"/>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <LivestockBreedingTable/>
            </v-col>
        </v-row>
    </v-sheet>
</template>
<script>
import axios from 'axios'
import LivestockBreedingTable from'@/components/admin/tables/LivestockBreedingTable.vue'
import AreaSpline from '@/components/general/charts/AreaSpline.vue'
export default {
    name: 'AdminLivestockBreedingMonitoring',
    data(){
        return{
            livestockBreedingRateData: null,
        }
    },
    components:{
        AreaSpline,
        LivestockBreedingTable,
    },
    methods:{
        async getLivestockBreedingRateData(){
            try {
                const response = await axios.get('apiCharts/getLivestockBreedingProgression');
                this.livestockBreedingRateData = response.data;
            } catch (error) {
                console.error('Error fetching livestock breeding rate data:', error);
                this.error = 'Failed to fetch livestock breeding rate data.';
            } finally {
                this.loading = false;
            }
        },
    },
    created(){
        this.getLivestockBreedingRateData()
    }
}
</script>
<style>
    
</style>