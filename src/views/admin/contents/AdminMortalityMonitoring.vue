<template>
    <v-sheet class="bg-transparent">
        <h1>Livestock Mortality Monitoring</h1>
        <v-row>
            <v-col cols="12" class="pa-4">
                <AreaSpline :chartData="livestockMortalityData" :chartTitle="'Livestock Mortality Rate'" :height="280" seriesName="Mortality Rate"/>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <LivestockMortalityTable/>
            </v-col>
        </v-row>
    </v-sheet>
</template>
<script>
import axios from 'axios'
import AreaSpline from '@/components/general/charts/AreaSpline.vue'
import LivestockMortalityTable from '@/components/admin/tables/LivestockMortalityTable.vue'

export default {
    name:'AdminLivestockMonitoringMonitoring',
    data(){
        return{
            livestockMortalityData: null,
        }
    },
    components:{
        AreaSpline,
        LivestockMortalityTable
    },
    created(){
        this.getLivestockMortalityData();
    },
    methods:{
        async getLivestockMortalityData(){
            try {
                const response = await axios.get('apiCharts/getLivestockMortality');
                this.livestockMortalityData = response.data;
            } catch (error) {
                console.error('Error fetching livestock mortality data:', error);
                this.error = 'Failed to fetch livestock mortality data.';
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
<style>
    
</style>