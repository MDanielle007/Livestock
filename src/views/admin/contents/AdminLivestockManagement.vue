<template>
  <v-sheet class="bg-transparent">
    <v-row no-gutters>
      <v-col cols="12" class="pa-4">
        <AreaSpline :chartData="livestockPopulationData" :chartTitle="'Livestock Population'" :height="280" seriesName="Population Rate"/>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <LivestockTable/>
      </v-col>
    </v-row>
  </v-sheet>
</template>
<script>
import axios from 'axios'
import LivestockTable from '../../../components/admin/tables/LivestockTable.vue'
import AreaSpline from '@/components/general/charts/AreaSpline.vue'

export default {
  name:'AdminLivestockManagement',
  components:{
    LivestockTable,
    AreaSpline,
  },
  data(){
    return{
      livestockPopulationData: null,
    }
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
  },
  created(){
    this.getLivestockPopulationData()
  }
}
</script>

<style>
  
</style>