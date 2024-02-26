<template>
    <div class="grid">
        <div class="col-12">
            <Toolbar class="mb-2 bg-white">
                <template v-slot:start>
                    <div class="flex gap-3 align-items-center">
                        <router-link :to="{ name: 'AdminLivestockMonitoring' }">
                            <Button icon="pi pi-chevron-left" />
                        </router-link>
                        <div class="text-xl font-bold text-700">
                            Livestock Age Classification Management
                        </div>
                    </div>
                </template>
            </Toolbar>
        </div>
        <div class="col-12">
            <LivestockAgeClassManagementDataTable/>
        </div>
    </div>
</template>
<script>
import LivestockAgeClassManagementDataTable from '@/components/general/datatables/LivestockAgeClassManagementDataTable.vue';
export default {
    components:{
        LivestockAgeClassManagementDataTable
    }
};
</script>
<style></style>
