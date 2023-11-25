<template>
    <div>
        <h1>
            ADMIN DASHBOARD
        </h1>
        <v-container title="Area Spline Chart">

          <v-row>
            <v-col cols="3">
                <v-card
                  width="auto"
                  title="This is a title"
                  subtitle="This is a subtitle"
                  text="This is content"
                ></v-card>
            </v-col>
            
            <v-col cols="3">
              <v-card
                width="auto"
                title="This is a title"
                subtitle="This is a subtitle"
                text="This is content"
              ></v-card>
          </v-col>

          <v-col cols="3">
            <v-card
              width="auto"
              title="This is a title"
              subtitle="This is a subtitle"
              text="This is content"
            ></v-card>
        </v-col>

        <v-col cols="3">
          <v-card
            width="auto"
            title="This is a title"
            subtitle="This is a subtitle"
            text="This is content"
          ></v-card>
         </v-col>
          </v-row>
          
            <v-row
                align="start"
              
            >
              <v-col cols="9">
                  <v-sheet class="custom-card" >
                      <SplineArea/>
                  </v-sheet>
              </v-col>

              <v-col cols="3">
                <v-card
                    height="365"
                    class="custom-card">
                    <template v-slot:title>
                    Livestock Ranking
                    </template>

                    <v-card-text>
                    This is content
                    </v-card-text>
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
              <v-col cols="7">
                <v-sheet>
                    <Bar/>
                </v-sheet>
            </v-col>
              <v-col cols="5">
                <v-sheet>
                    <Pie/>
                </v-sheet>
                <v-card
                  class="mx-auto my-5 custom-card"
                  max-width="auto"
                  height="115"
                  title="Hover and click me"
                  subtitle="Same looks, no anchor"
                  link
                ></v-card>
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

export default{
    name:'AdminDashboard',
    components:{
        AreaSplineChart,
        Bar,
        SplineArea,
        Pie
    },
    
}
</script>
<style scoped>
.custom-card {
  border-radius: 8px; /* Add desired border-radius */
}
</style>
