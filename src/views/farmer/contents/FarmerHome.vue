<template>
    <div>
        <h2>Farmer Dashboard </h2>
    </div>

    <div >
        <h4>Chicken</h4> 
    </div>
    <v-container>
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
            
            <v-col >
                <v-sheet>
                    <Column/>
                </v-sheet>
            </v-col>
        </v-row>

        <v-row>
            <v-col >
                <v-sheet>
                    <RadialBar/>
                </v-sheet>
            </v-col>
        </v-row>
        
    </v-container>
</template>
<script>
import Column from  '../../../components/farmer/visualizations/Column.vue'
import RadialBar from '../../../components/farmer/visualizations/RadialBar.vue'
export default{
    name:'FarmerHome',
    components:{
       Column,
       RadialBar,
       
    },
    
}
</script>
<style>
    h2 {
    color: #1A237E;}

    h4 {
        font-weight: 500,}
</style>