<template>
    <div>
        <h2>Farmer Dashboard </h2>
    </div>

    <div >
        <h4>Chicken</h4> 
    </div>
    <v-row no-gutters>
        <v-col cols="4">
            <v-card
                class="my-2 mx-1 bg-indigo-darken-4"
                flat    
                height="100"
                >
                <v-card-item>
                    <v-card-title>
                    Chicks
                    </v-card-title>
                    <v-card-subtitle    >
                        Total number of chicks addded in the month of November
                    </v-card-subtitle>
                </v-card-item>
                
            </v-card>
        </v-col>

        <v-col cols="4">
            <v-card
                class="my-2 mx-1 bg-indigo-darken-4"
                flat    
                height="100"    
                >
                <v-card-item>
                    <v-card-title>
                    Pullets
                    </v-card-title>
                    <v-card-subtitle    >
                        Total number of chicks addded in the month of November
                    </v-card-subtitle>
                </v-card-item>
                
            </v-card>
        </v-col>

        <v-col cols="4">
            <v-card
                class="my-2 mx-1 bg-indigo-darken-4"
                flat    
                height="100"    
                >
                <v-card-item>
                    <v-card-title>
                    Hens
                    </v-card-title>
                    <v-card-subtitle    >
                        Total number of chicks addded in the month of November
                    </v-card-subtitle>
                </v-card-item>
                
            </v-card>
        </v-col>

        <v-col cols="6">
            <v-card
                class="my-2 mr-2 bg-indigo-darken-4"
                flat
                height="100"  
            >
                <v-card-item>
                <v-icon icon="fa-solid fa-users"></v-icon>
                <v-card-title>
                    Cockerel
                </v-card-title>
                </v-card-item>
            </v-card>
        </v-col>

        <v-col cols="6">
            <v-card
                class="my-2  gap-5 "
                flat
                height="100"  
            >
                <v-card-item>
                <v-icon icon="fa-solid fa-users"></v-icon>
                <v-card-title>
                    Rooster
                </v-card-title>
                </v-card-item>

                
            </v-card>
        </v-col>
    </v-row>

    <v-row>
        <v-col cols="12" sm="8" class="py-2 px-1">
            <ColumnChart :chart-data="farmerLivestockPopulationData" :chart-title="'Population Rate'" :height="200" :series-name="'Population Rate'"/>
        </v-col>
        <v-col cols="12" sm="4" class="py-2 px-1">
            <DonutChart :chart-data="farmerLivestockPopulationDataAgeClass" :height="210"/>
        </v-col>
    </v-row>
</template>
<script>

import axios from 'axios'
import { getCookie } from '@/utils/cookieUtils.js'
import { jwtDecode as jwt_decode } from 'jwt-decode';
import ColumnChart from '@/components/general/charts/ColumnChart.vue';
import DonutChart from '@/components/general/charts/DonutChart.vue';


export default{
    name:'FarmerHome',
    components:{
       ColumnChart,
       DonutChart,
    },
    data(){
        return{
            farmerLivestockPopulationData: null,
            farmerLivestockPopulationDataAgeClass: null,
            userid: '',
        }
    },
    methods:{
        async getFarmerLivestockPopulationData(){
            try {
                const response = await axios.get(`apiCharts/getFarmerLivestockPopulationProgression/${this.userid}`)
                this.farmerLivestockPopulationData = response.data
                console.log(response.data);
                console.log(this.farmerLivestockPopulationData);
            } catch (error) {
                console.log(error);
            }
        },
        async getFarmerLivestockPopulationProgressionAgeClass() {
            try {
                const response = await axios.get(`apiCharts/getFarmerLivestockPopulationProgressionAgeClass/${this.userid}`);
                this.farmerLivestockPopulationDataAgeClass = {
                    labels: response.data.labels,
                    data: response.data.data.map(Number), // Convert count values to numbers
                };
                console.log(response.data);
                console.log(this.farmerLivestockPopulationDataAgeClass);
            } catch (error) {
                console.log(error);
            }
        },
    },  
    created(){
        const token = getCookie('token');
        const decodedToken = jwt_decode(token);
        this.userid = decodedToken.userid

        this.getFarmerLivestockPopulationData();
        this.getFarmerLivestockPopulationProgressionAgeClass()
    }
    
}
</script>
<style>
    h2 {
    color: #1A237E;}

    h4 {
        font-weight: 500,}
</style>