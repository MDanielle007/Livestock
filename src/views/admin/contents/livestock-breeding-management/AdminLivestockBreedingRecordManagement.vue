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
                            Livestock Breeding Records
                        </div>
                    </div>
                </template>
            </Toolbar>
        </div>
        <div class="col-12">
            <AdminLivestockBreedingRecordManagement/>
        </div>
    </div>
</template>
<script>
import AdminLivestockBreedingRecordManagement from "@/components/general/datatables/LivestockBreedingRecordManagementDataTable.vue"
export default {
    components:{
        AdminLivestockBreedingRecordManagement
    }
}
</script>
<style>
    
</style>