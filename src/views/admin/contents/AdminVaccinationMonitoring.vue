<template>
    <v-sheet class="bg-transparent">
        <h1>Livestock Vaccination Monitoring</h1>
        <v-row>
            <v-col cols="12" >
                <AreaSpline :chartData="livestockVaccinationData" chartTitle="Livestock Vaccination Rate" :height="280" seriesName="Vaccination Rate" :seriesColors="['#49FF00']"/>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <LivestockVaccinationTable/>
            </v-col>
        </v-row>
    </v-sheet>
</template>
<script>
import LivestockVaccinationTable from '@/components/admin/tables/LivestockVaccinationTable.vue'
import AreaSpline from '@/components/general/charts/AreaSpline.vue'
import axios from 'axios'

export default {
    name:'AdminVaccinationMonitoring',
    data(){
        return{
            livestockVaccinationData:null,
        }
    },
    components:{
        AreaSpline,
        LivestockVaccinationTable
    },
    methods:{
        async getLivestockPopulationData(){
            try {
                const response = await axios.get('apiCharts/getLivestockVaccinationProgression');
                this.livestockVaccinationData = response.data;
            } catch (error) {
                console.error('Error fetching livestock vaccination data:', error);
                this.error = 'Failed to fetch livestock vaccination data.';
            } finally {
                this.loading = false;
            }
        },
    },
    created(){
        this.getLivestockPopulationData()
    }
}
</script>