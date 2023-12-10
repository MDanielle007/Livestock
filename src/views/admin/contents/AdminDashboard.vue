<template>
  <div class="text-indigo-darken-4">
    <h1>
      ADMIN DASHBOARD
    </h1>
    <v-container title="Area Spline Chart">

      <v-row>
         
        <v-col>
          <v-card width="auto" height="130" flat :elevation="1" class="rounded-lg">
            <div class="d-flex pt-5">
              <v-card-subtitle class="subtitle-1">Registred Farmers</v-card-subtitle>
              <p class="font-weight-bold ml-4 mt-3 text-red"> 26%</p>
            </div>
            <div style="display: flex; align-items: center; justify-content: flex-end;">
              <span class="text-h4 mt-2" style="margin-right: 60px;">75</span>
              <div style="width: 50px; height: 50px; margin-right: 10px; margin-top: 5px;">
                <v-img src="@/assets/images/farmer.png" contain></v-img>
              </div>
            </div>
            
          </v-card>
        </v-col>



        <v-col cols="2" class="ma-1 pa-2" >
          <v-card width="auto" height="130" flat :elevation="1" class="rounded-lg">
            <div class="d-flex pt-5">
              <v-card-subtitle class="subtitle-1">Livestock <br> Population</v-card-subtitle>
              <p class="font-weight-bold ml-4 mt-3 text-red"> 26%</p>
            </div>
            <div style="display: flex; align-items: center; justify-content: flex-end;">
              <span class="text-h4 mt-2" style="margin-right: 60px;">75</span>
              <div style="width: 50px; height: 50px; margin-right: 10px; margin-top: 5px;">
                <v-img src="@/assets/images/barn.png" contain></v-img>
              </div>
            </div>
          </v-card>
        </v-col>

        <v-col cols="2" class="ma-1 pa-2">
          <v-card width="auto" height="130" flat :elevation="1" class="rounded-lg">
            <div class="d-flex pt-5">
              <v-card-subtitle class="subtitle-1">Livestock <br> Monitored</v-card-subtitle>
              <p class="font-weight-bold ml-4 mt-3 text-red"> 26%</p>
            </div>
            <div style="display: flex; align-items: center; justify-content: flex-end;">
              <span class="text-h4 mt-2" style="margin-right: 60px;">75</span>
              <div style="width: 50px; height: 50px; margin-right: 10px; margin-top: 5px;">
                <v-img src="@/assets/images/farmHouse.png" contain></v-img>
              </div>
            </div>
          </v-card>
        </v-col>


        <v-col cols="2" class="ma-1 pa-2">
          <v-card width="auto" height="130" flat :elevation="1" class="rounded-lg">
            <div class="d-flex pt-5">
              <v-card-subtitle class="subtitle-1">Mortality <br> Rate</v-card-subtitle>
              <p class="font-weight-bold ml-4 mt-3 text-red"> 26%</p>
            </div>
            <div style="display: flex; align-items: center; justify-content: flex-end;">
              <span class="text-h4 mt-2" style="margin-right: 60px;">75</span>
              <div style="width: 50px; height: 50px; margin-right: 10px; margin-top: 5px;">
                <v-img src="@/assets/images/daed.png" contain></v-img>
              </div>
            </div>
          </v-card>
        </v-col>

        <v-col cols="2" class="ma-1 pa-2">
          <v-card width="auto" height="130" flat :elevation="1" class="rounded-lg">
            <div class="d-flex pt-5">
              <v-card-subtitle class="subtitle-1">Registred <br> Farmers</v-card-subtitle>
              <p class="font-weight-bold ml-4 mt-3 text-red"> 26%</p>
            </div>
            <div style="display: flex; align-items: center; justify-content: flex-end;">
              <span class="text-h4 mt-2" style="margin-right: 60px;">75</span>
              <div style="width: 50px; height: 50px; margin-right: 10px; margin-top: 5px;">
                <v-img src="@/assets/images/farmer.png" contain></v-img>
              </div>
            </div>
          </v-card>
        </v-col>
       
      

      </v-row>

      <v-row class="mt-5" align="start" no-gutters>
        <v-col cols="9"> 
          <SplineArea />
        </v-col>

        <v-col cols="3">
          <v-card class="ml-4" width="268" height="525">
            <p class="font-weight-bold ml-4 mt-3 text-indigo-darken-4">Weekly Stats</p>
            <p class=" ml-4 text-orange-darken-4"> Livestock Dynamics</p>
            <div>
              <LineGradient/>  
            </div>
            <v-divider></v-divider>
              <div class="ml-7 mt-7">
                <v-row>
                  <v-title class="text-h6 ml-2 mt-4 " >
                              Cattle
                  </v-title>
                  <v-divider class="mt-2 mr-7"></v-divider>
                </v-row>
              
                <v-row>
                  <v-title class="text-h6 ml-2 mt-4" >
                              Chicken
                  </v-title>
                  <v-divider class="mt-2 mr-7"></v-divider>
                </v-row>
                <v-row>
                  <v-title class="text-h6 ml-2 mt-4" >
                              Lamb
                  </v-title>
                  <v-divider class="mt-2 mr-7"></v-divider>
                </v-row>
                <v-row>
                  <v-title class="text-h6 ml-2 mt-4 " >
                              Sheep
                  </v-title>
                </v-row>
              </div>
           

          </v-card>
        </v-col>
      </v-row>

      


      <v-row>
        <v-col cols="4">
            <Pie />
        </v-col>

        <v-col cols="8">
          <v-sheet>
            <Bar />
          </v-sheet>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="6">
          <div>
            <v-sheet height="430" >
                <v-col class=" pa-0 ">
                  <div>
                    <v-card-title >Annually Rate</v-card-title>
                  </div>
                </v-col>
              <LineChart />
            </v-sheet>
          </div>
        </v-col>

        <v-col cols="6">
          <div>
            <v-sheet height="430" >
                <v-col class=" pa-0 ">
                  <div>
                    <v-card-title >Annually Rate</v-card-title>
                  </div>
                </v-col>
              <LineChart />
            </v-sheet>
          </div>
        </v-col>

      </v-row>
    </v-container>
  </div>
</template>
<script>
import AreaSplineChart from '../../../components/admin/visualizations/AreaSplineChart'
import Bar from '../../../components/admin/visualizations/Bar'
import SplineArea from '../../../components/admin/visualizations/SplineArea'
import Pie from '../../../components/admin/visualizations/Pie.vue'
import LineChart from '../../../components/admin/visualizations/LineChart.vue'
import LineChartZoomable from '../../../components/admin/visualizations/LineChartZoomable.vue'
import LineGradient from '../../../components/admin/visualizations/LineGradient'

export default {
  name: 'AdminDashboard',
  components: {
    AreaSplineChart,
    Bar,
    SplineArea,
    Pie,
    LineChart,
    LineChartZoomable,
    LineGradient, 

  }
}
</script>

<style scoped></style>
