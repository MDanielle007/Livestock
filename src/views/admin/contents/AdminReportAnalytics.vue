<template>
    <div>
        <h1>
            Admin Report and Analytics
        </h1>
        <v-container>
            <v-row>
                <v-col cols="8">
                    <v-sheet>
                        <MultipleYAxis/>
                    </v-sheet>
                </v-col>

                <v-col>
                    <v-row>
                        <v-col >
                            <v-card
                              class="mx-auto"
                              max-width="344"
                              title="Icons"
                              subtitle="prepend-icon and append-icon"
                              prepend-icon="mdi:mdi-account"
                              append-icon="mdi:mdi-check"
                            >
                              <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                            </v-card>
                        </v-col>
                    
                        <v-col >
                        <v-card
                            class="mx-auto"
                            max-width="344"
                            title="Icons"
                            subtitle="prepend and append"
                        >
                            <template v-slot:prepend>
                            <v-icon icon="mdi:mdi-account" color="primary"></v-icon>
                            </template>
                            <template v-slot:append>
                            <v-icon icon="mdi:mdi-check" color="success"></v-icon>
                            </template>
                            <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                        </v-card>
                        </v-col>
        
                        <v-col >
                        <v-card
                            class="mx-auto"
                            max-width="344"
                            title="Icons"
                            subtitle="prepend-icon and append-icon"
                            prepend-icon="mdi:mdi-account"
                            append-icon="mdi:mdi-check"
                        >
                            <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                        </v-card>
                        </v-col>
                    
                        <v-col >
                        <v-card
                            class="mx-auto"
                            max-width="344"
                            title="Icons"
                            subtitle="prepend and append"
                        >
                            <template v-slot:prepend>
                            <v-icon icon="mdi:mdi-account" color="primary"></v-icon>
                            </template>
                            <template v-slot:append>
                            <v-icon icon="mdi:mdi-check" color="success"></v-icon>
                            </template>
                            <v-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</v-card-text>
                        </v-card>
                        </v-col>
                    </v-row>
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