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
                <v-col>
                    <p class="text-subtitle-2 text-right">
                        See more
                    </p>
                </v-col>

            </v-row>

            <v-row>
                <v-col>
                    <v-card
                      class="mx-auto"
                      max-width="400"
                      height="140"
                      title="Cattle"
                      subtitle="Livestock Inventory Today"
                    >
                      <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                    </v-card>
                </v-col>

                <v-col >
                    <v-card
                      class="mx-auto"
                      max-width="400"
                      height="140"
                      title="Cattle"
                      subtitle="Livestock Inventory Today"
                    >
                      <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                    </v-card>
                </v-col>
            
                <v-col >
                    <v-card
                      class="mx-auto"
                      max-width="400"
                      height="140"
                      title="Cattle"
                      subtitle="Livestock Inventory Today"
                    >
                      <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                    </v-card>
                </v-col>

                <v-col >
                    <v-card
                      class="mx-auto"
                      max-width="400"
                      height="140"
                      title="Cattle"
                      subtitle="Livestock Inventory Today"
                    >
                      <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="8">
                    <v-sheet>
                        <MultipleYAxis/>
                    </v-sheet>
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

export default{
    name:'AdminReportAnalytics',
    components:{
        MultipleYAxis, 
        ReportAnalysisTable
    }
}
</script>
<style>
    
</style>