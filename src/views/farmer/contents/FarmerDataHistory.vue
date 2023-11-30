<template>
    <div>
        <h2>Farmer Data History</h2>
        <DataHistory/>
    </div>
</template>
<script>
import { defineComponent } from 'vue';
// import DataHistoryTable from '../../../components/farmer/tables/FarmerDataHistoryTable.vue'
import DataHistory from '@/components/farmer/DataHistory.vue'

export default defineComponent({
    name: 'FarmerDataHistory',
    components:{
        // DataHistoryTable
        DataHistory
    }
})
</script>
<style>
    
</style>