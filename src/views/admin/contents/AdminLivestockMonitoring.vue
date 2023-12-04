<template>
    <div>
        <h1>Livestock Monitoring</h1>
    </div>
    <v-sheet class="bg-transparent">
        <v-row no-gutters>
            <v-col cols="12" sm="6" md="4" class="py-2 px-1" >
                <AreaSpline :chartData="livestockPopulationData" :chartTitle="'Livestock Population'" :height="'auto'" seriesName="Population Rate"/>
            </v-col>
            <v-col cols="12" sm="6" md="4" class="py-2 px-1">
                <AreaSpline :chartData="livestockBreedingRateData" :chartTitle="'Livestock Breeding Rate'" :height="'auto'" seriesName="Breeding Rate"/>
            </v-col>
            <v-col cols="12" sm="6" md="4" class="py-2 px-1" >
                <AreaSpline :chartData="livestockMortalityData" :chartTitle="'Livestock Mortality Rate'" :height="'auto'" seriesName="Mortality Rate"/>
            </v-col>
        </v-row>

        <v-row no-gutters>
            <!-- Total Livestock Population Card -->
            <v-col cols="3" class="py-4 px-1">
                <MetricCard
                    cardTitle="Total Livestock Population"
                    cardDescription="This card displays the total livestock population."
                    cardMetrics="Livestocks: 500"
                />
            </v-col>

            <!-- Livestock Types Monitored Card -->
            <v-col cols="3" class="py-4 px-1">
                <MetricCard
                    cardTitle="Livestock Types Monitored"
                    cardDescription="This card shows the distinct livestock types and their counts."
                    cardMetrics="Chicken: 200 | Goat: 150 | Cattle: 100"
                />
            </v-col>

            <!-- Livestock Mortality Rate Card -->
            <v-col cols="3" class="py-4 px-1">
                <MetricCard
                    cardTitle="Livestock Mortality Rate"
                    cardDescription="This card provides the mortality rate based on reported deaths."
                    cardMetrics="Mortality Rate: 5%"
                />
            </v-col>

            <!-- Livestock Breeding Status Card -->
            <v-col cols="3" class="py-4 px-1">
                <MetricCard
                    cardTitle="Livestock Breeding Status"
                    cardDescription="This card indicates the breeding status of livestock."
                    cardMetrics="Eligible for Breeding: 70%"
                />
            </v-col>
        </v-row>
        <v-row no-gutters>
            <router-view></router-view>
        </v-row>
    </v-sheet>
</template>
<script>
import AreaSpline from '@/components/general/charts/AreaSpline.vue'
import MetricCard from '@/components/general/commons/MetricCard.vue'
import LivestockTable from '@/components/admin/tables/LivestockTable.vue'
import axios from 'axios'

export default {
    name: 'admin-livestock-monitoring',
    data(){
        return{
            livestockPopulationData: null,
            livestockBreedingRateData: null,
            livestockMortalityData: null,
            loading: true,
            error: null,
        }
    },
    components:{
        AreaSpline,
        MetricCard,
        LivestockTable
    },
    methods:{
        async getLivestockPopulationData(){
            try {
                const response = await axios.get('apiCharts/getLivestockPopulationProgression');
                this.livestockPopulationData = response.data;
            } catch (error) {
                console.error('Error fetching livestock population data:', error);
                this.error = 'Failed to fetch livestock population data.';
            } finally {
                this.loading = false;
            }
        },
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
    },
    created(){
        this.getLivestockPopulationData()
        this.getLivestockBreedingRateData()
        this.getLivestockMortalityData()
    }
}
</script>
<style>
    
</style>