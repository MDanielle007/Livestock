<template>
    <v-window v-model="$store.state.tabs.activeTab" class="mb-16">
        <v-window-item value="one">
            <CRUDLivestockTable/>
        </v-window-item>

        <v-window-item value="two">
            <VaccinationTable/>
        </v-window-item>

        <v-window-item value="three">
            <BreedingForm/>
        </v-window-item>

        <v-window-item value="four">
            <MortalityTable/>
        </v-window-item>
    </v-window>
</template>

<script>
import CRUDLivestockTable from '@/components/farmer/tables/CRUDLivestockTable.vue'
import VaccinationTable from '@/components/farmer/tables/VaccinationTable.vue'
import MortalityTable from '@/components/farmer/tables/MortalityTable.vue'
import BreedingForm from '@/components/farmer/forms/BreedingForm.vue'
import store from '@/store';

export default{
    name: 'FarmerLivestockManagement',
    data(){
        return{
        }
    },
    computed: {
        tab: {
            get() {
                return store.state.tab.activeTab;
            },
        },
    },
    components:{
        CRUDLivestockTable,
        VaccinationTable,
        MortalityTable,
        BreedingForm,
    },
}
</script>
<style>
/* Add your styles here */
</style>
