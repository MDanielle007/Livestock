<template>
    <div>
        <h1>Farmer Data History</h1>
        <DataHistoryTable/>
    </div>
</template>
<script>
import { defineComponent } from 'vue';
import DataHistoryTable from '../../../components/farmer/tables/FarmerDataHistoryTable.vue'

export default defineComponent({
    name: 'FarmerDataHistory',
    components:{
        DataHistoryTable
    }
})
</script>
<style>
    
</style>