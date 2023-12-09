<template>
    <div class="text-indigo-darken-4">
        <h1>
            ADMIN DASHBOARD
        </h1>
        <v-container title="Area Spline Chart">

          <v-row>
      
          
            <v-col cols="3">
              <v-card width="auto" height="115" flat :elevation="1" class="rounded-lg">
                <div class="d-flex pt-5">
                  <v-card-subtitle class="subtitle-1">Total Livestock Population</v-card-subtitle> 
                </div>
                <div style="display: flex; align-items: center; justify-content: flex-end;">
                  <span class="text-h3 mt-2" style="margin-right: 130px;">75</span>
                  <div style="width: 60px; height: 60px;">
                    <v-img src="@/assets/images/barn.png" contain></v-img>
                  </div>
                </div>
              </v-card>
            </v-col>
            
            
            <v-col cols="3">
              <v-card width="auto" height="115" flat :elevation="1" class="rounded-lg">
                <div class="d-flex pt-5">
                  <v-card-subtitle class="subtitle-1">Livestock-Monitored</v-card-subtitle> 
                </div>
                <div style="display: flex; align-items: center; justify-content: flex-end;">
                  <span class="text-h3 mt-2" style="margin-right: 130px;">75</span>
                  <div style="width: 60px; height: 60px;">
                    <v-img src="@/assets/images/farmHouse.png" contain></v-img>
                  </div>
                </div>
              </v-card>
            </v-col>
            

            <v-col cols="3">
              <v-card width="auto" height="115" flat :elevation="1" class="rounded-lg">
                <div class="d-flex pt-5">
                  <v-card-subtitle class="subtitle-1">Mortality Rate</v-card-subtitle> 
                </div>
                <div style="display: flex; align-items: center; justify-content: flex-end;">
                  <span class="text-h3 mt-2" style="margin-right: 130px;">75</span>
                  <div style="width: 60px; height: 60px;">
                    <v-img src="@/assets/images/daed.png" contain></v-img>
                  </div>
                </div>
              </v-card>
            </v-col>
            
            <v-col cols="3">
              <v-card width="auto" height="115" flat :elevation="1" class="rounded-lg">
                <div class="d-flex pt-5">
                  <v-card-subtitle class="subtitle-1">Registred Farmers</v-card-subtitle> 
                </div>
                <div style="display: flex; align-items: center; justify-content: flex-end;">
                  <span class="text-h3 mt-2" style="margin-right: 130px;">75</span>
                  <div style="width: 60px; height: 60px;">
                    <v-img src="@/assets/images/farmer.png" contain></v-img>
                  </div>
                </div>
              </v-card>
            </v-col>
            
    </v-row>
          
            <v-row
                align="start">
              <v-col cols="9">
                  <v-sheet :elevation="1" >
                      <SplineArea/>
                  </v-sheet>
              </v-col>

              <v-col cols="3">
                  <v-card
                    class="mx-auto"
                    width="256"
                  >
                    <v-layout>
                      <v-navigation-drawer permanent absolute>
                        <v-list>
                          <v-list-item
                           
                            title="Livestock Dynamics">
                            
                          </v-list-item>
                        </v-list>
                
                        <v-divider></v-divider>
                
                        <v-list
                          :lines="false"
                          density="compact"
                          nav
                        >
                          <v-list-item
                            v-for="(item, i) in items"
                            :key="i"
                            
                            color="primary"
                          >
                            <template v-slot:prepend>
                              <v-icon :icon="item.icon"></v-icon>
                            </template>
                
                            <v-list-item-title  v-text="item.text"></v-list-item-title>
                          </v-list-item>
                        </v-list>
                      </v-navigation-drawer>
                
                      <v-main style="height: 350px;"></v-main>
                    </v-layout>
                  </v-card>
              </v-col>

            </v-row>

            <v-row align="left" justify="left">
              <v-col
                v-for="(variant, i) in variants"
                :key="i"
              ><v-card
                  class="mx-auto custom-card"
                  max-width="280"
                  height="100"
                  :color="color"
                  :variant="variant"
                ></v-card>
              </v-col>
            </v-row>

            

            <v-row>
              <v-col cols="4">
                <v-sheet :elevation="1">
                  <Pie/>
                </v-sheet>

                <v-card width="auto" height="115" flat :elevation="1" class=" mt-5">
                  <div class="d-flex pt-5">
                    <v-card-subtitle class="subtitle-1">Total Livestock Population</v-card-subtitle> 
                  </div>
                  <div style="display: flex; align-items: center; justify-content: flex-end;">
                    <span class="text-h3 mt-2" style="margin-right: 130px;">75</span>
                    <div style="width: 60px; height: 60px;">
                      <v-img src="@/assets/images/barn.png" contain></v-img>
                    </div>
                  </div>
                </v-card>
              </v-col>

              <v-col cols="8">
                <v-sheet>
                  <Bar/>
                </v-sheet>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="6">
                <v-sheet>
                  <LineChart/>
                </v-sheet>
              </v-col>

              <v-col cols="6">
                <v-sheet>
                  <LineChart/>
                </v-sheet>
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

export default {
  name: 'AdminDashboard',
  components: {
    AreaSplineChart,
    Bar,
    SplineArea,
    Pie,
    LineChart,

  },
  data: () => ({
    items: [
      { text: 'My Files', icon: 'mdi:mdi-folder' },
      { text: 'Shared with me', icon: 'mdi:mdi-account-multiple' },
      { text: 'Starred', icon: 'mdi:mdi-star' },
      { text: 'Recent', icon: 'mdi:mdi-history' },
  
    ],
  }),
}
</script>

<style scoped>

</style>
