<template>
    <div class="grid">
        <div class="col-12">
            <Toolbar class="mb-2 bg-white">
                <template v-slot:start>
                    <div class="flex gap-3 align-items-center">
                        <router-link :to="{ name: 'AdminLivestockBreedingMonitoring' }">
                            <Button icon="pi pi-chevron-left" />
                        </router-link>
                        <div class="text-xl font-bold text-700">
                            Livestock Pregnancy Records
                        </div>
                    </div>
                </template>
            </Toolbar>
        </div>
        <div class="col-12">
            <AdminLivestockPregnancyRecordManagementDataTable/>
        </div>
    </div>
</template>
<script>
import AdminLivestockPregnancyRecordManagementDataTable from "@/components/general/datatables/LivestockPregnancyRecordManagementDataTable.vue"
export default {
    components:{
        AdminLivestockPregnancyRecordManagementDataTable
    }
}
</script>
<style>
    
</style>