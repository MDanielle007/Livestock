<template>
    <div class="d-flex flex-wrap ga-3 justify-center">
        <v-card width="100" flat :elevation="1" class="rounded-lg flex-grow-1" v-for="cardData in farmerCardData">
            <div class="d-flex flex-column">
                <v-card-title class="bg-amber font-weight-bold py-0 px-4 ma-0 text-subtitle-1">
                    {{ cardData.Age_Classification }}
                </v-card-title>
                <span class="text-caption bg-amber-darken-1 px-4 text-white">
                    {{ cardData.Livestock_Type }}
                </span>
                <v-divider></v-divider>
            </div>
            <v-card-text class="d-flex justify-space-between align-center px-4 ga-2 pt-2">
                <span class="text-h4">{{ cardData.LivestockCount }}</span>
                <div>
                    <v-img :src="getImagePath(cardData.Livestock_Type)" contain width="40" height="40"></v-img>
                </div>
            </v-card-text>
        </v-card>
        <v-card class="flex-grow-1 rounded-lg">
            <div class="d-flex flex-column">
                <v-card-title class="bg-amber font-weight-bold py-3 px-3 ma-0 text-h6">
                    Total Livestock
                </v-card-title>
                <v-divider></v-divider>
            </div>
            <v-card-text class="d-flex justify-space-between align-center pt-2">
                <div>
                    <span class="text-h4">{{livestockCounts}}</span>
                    <span class="text-subtitle-1">Livestocks</span>
                </div>
                <div>
                    <v-img src="@/assets/images/farmer.png" contain width="40" height="40"></v-img>
                </div>
            </v-card-text>
        </v-card>
    </div>

    <v-row class="my-3">
        <v-col v-if="farmerLivestockTypes" cols="12" sm="8" class="py-2 px-1">
            <DistributedChart :chart-data="farmerLivestockTypes" :height="210" seriesName="Livestock Type"/>
        </v-col>
        <v-col v-if="farmerLivestockPopulationDataAgeClass" cols="12" md="4" class="py-2 px-1">
            <DonutChart :chart-data="farmerLivestockPopulationDataAgeClass" :height="210" seriesName="Age Classification"/>
        </v-col>
    </v-row>
</template>
<script>

import axios from 'axios'
import { getCookie } from '@/utils/cookieUtils.js'
import { jwtDecode as jwt_decode } from 'jwt-decode';
import DonutChart from '@/components/general/charts/DonutChart.vue';
import DistributedChart from '@/components/general/charts/DistributedChart.vue'


export default{
    name:'FarmerHome',
    components:{
       DonutChart,
       DistributedChart,
    },
    data(){
        return{
            farmerLivestockPopulationData: null,
            farmerLivestockPopulationDataAgeClass: null,
            userid: '',
            farmerCardData: [],
            farmerLivestockTypes: null,
            livestockCounts:''
        }
    },
    methods:{
        async getFarmerLivestockPopulationData(){
            try {
                const response = await axios.get(`apiCharts/getFarmerLivestockTypes/${this.userid}`)
                this.farmerLivestockTypes = {
                    labels: response.data.labels,
                    data: response.data.data.map(Number), // Convert count values to numbers
                };
                console.log(response.data);
                console.log(this.farmerLivestockTypes);
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
        async getfarmerDashboardCards(){
            try {
                const response = await axios.get(`apiCharts/getfarmerDashboardCards/${this.userid}`);
                console.log(response.data); 
                this.farmerCardData = response.data
            } catch (error) {
                console.log(error);
            }
        },
        getImagePath(type) {
            switch (type) {
                case 'Cattle':
                    return require('@/assets/images/livestockType/icons8-cattle-96.png');
                case 'Chicken':
                    return require('@/assets/images/livestockType/icons8-chicken-96.png');
                case 'Goat':
                    return require('@/assets/images/livestockType/icons8-goat-96.png');
                case 'Pig':
                    return require('@/assets/images/livestockType/icons8-pig-96.png');
                case 'Sheep':
                    return require('@/assets/images/livestockType/icons8-sheep-96.png');
                case 'Carabao':
                    return require('@/assets/images/livestockType/icons8-water-buffalo-96.png');
                default:
                    return ''; // You can provide a default image path if needed
            }
        },
        async getFarmerLivestockCount(){
            try {
                const response = await axios.get(`apiCharts/getFarmerLivestockCount/${this.userid}`);
                console.log(response.data); 
                this.livestockCounts = response.data
            } catch (error) {
                console.log(error);
            }
        }
    },  
    created(){
        const token = getCookie('token');
        const decodedToken = jwt_decode(token);
        this.userid = decodedToken.userid

        this.getFarmerLivestockPopulationData();
        this.getFarmerLivestockPopulationProgressionAgeClass()
        this.getfarmerDashboardCards()
        this.getFarmerLivestockCount()
    }
    
}
</script>
<style>
    h2 {
    color: #1A237E;}

    h4 {
        font-weight: 500,}
</style>