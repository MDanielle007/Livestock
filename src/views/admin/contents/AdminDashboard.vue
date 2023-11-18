<template>
    <div>
        <h1>
            Admin Dashboard
        </h1>
        <v-container title="Area Spline Chart">
            <v-row
                align="start"
                no-gutters
                style="height: 150px;"
            >
                <v-col>
                    <v-sheet class="pa-2 ma-2">
                        <AreaSplineChart/>
                    </v-sheet>
                </v-col>
                <v-col>
                    <v-sheet class="pa-2 ma-2">
                        <AreaSplineChart/>
                    </v-sheet>
                </v-col>
            </v-row>
            
        </v-container>
    </div>
</template>
<script>
import AreaSplineChart from '../../../components/admin/visualizations/AreaSplineChart'

export default{
    name:'AdminDashboard',
    components:{
        AreaSplineChart,
    }
}
</script>
<style>
    
</style>