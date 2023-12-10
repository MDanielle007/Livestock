<template>
    <div>
        <h1>
            Admin Report and Analytics
        </h1>
        <v-container>
            <v-row>
                <p class="text-h6 text-left">
                    Municipalities of Oriental Mindoro
                </p>
            </v-row>

            <v-row>
                <v-col>
                    <v-card class="mx-auto" max-width="500" height="auto">
                    <div >
                        <v-card-title class="pa-0 ml-3 mt-3">
                            Puerto Galera
                        </v-card-title>
                    </div>
                    <div class="d-flex" >
                       <v-card-subtitle >Total Livestock</v-card-subtitle>
                       <p class="font-weight-bold ml-10 text-orange-darken-4 text-h4"> 26%</p>
                    </div>
                    <div>
                      <LineGradient/>  
                    </div>
                    </v-card>  
                </v-col>

                <v-col>
                    <v-card class="mx-auto" max-width="500" height="auto">
                    <div >
                        <v-card-title class="pa-0 ml-3 mt-3">
                            Puerto Galera
                        </v-card-title>
                    </div>
                    <div class="d-flex" >
                       <v-card-subtitle >Total Livestock</v-card-subtitle>
                       <p class="font-weight-bold ml-10 text-orange-darken-4 text-h4"> 26%</p>
                    </div>
                    <div>
                      <LineGradient/>  
                    </div>
                    </v-card>  
                </v-col>

                <v-col>
                    <v-card class="mx-auto" max-width="500" height="auto">
                    <div >
                        <v-card-title class="pa-0 ml-3 mt-3">
                            Puerto Galera
                        </v-card-title>
                    </div>
                    <div class="d-flex" >
                       <v-card-subtitle >Total Livestock</v-card-subtitle>
                       <p class="font-weight-bold ml-10 text-orange-darken-4 text-h4"> 26%</p>
                    </div>
                    <div>
                      <LineGradient/>  
                    </div>
                    </v-card>  
                </v-col>

               <v-col>
                    <v-card class="mx-auto" max-width="500" height="auto">
                    <div >
                        <v-card-title class="pa-0 ml-3 mt-3">
                            Puerto Galera
                        </v-card-title>
                    </div>
                    <div class="d-flex" >
                       <v-card-subtitle >Total Livestock</v-card-subtitle>
                       <p class="font-weight-bold ml-10 text-orange-darken-4 text-h4"> 26%</p>
                    </div>
                    <div>
                      <LineGradient/>  
                    </div>
                    </v-card>  
                </v-col>

                
            </v-row>
            <v-row>
                <v-col>
                    <ReportAnalysisTable/>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
<script>
import MultipleYAxis from '../../../components/admin/visualizations/MultipleYAxis.vue'
import ReportAnalysisTable from '../../../components/admin/tables/ReportAnalysisTable.vue'
import LineGradient from '../../../components/admin/visualizations/LineGradient.vue'

export default{
    name:'AdminReportAnalytics',
    components:{
        MultipleYAxis, 
        ReportAnalysisTable,
        LineGradient,
    }
}
</script>
<style>
    
</style>