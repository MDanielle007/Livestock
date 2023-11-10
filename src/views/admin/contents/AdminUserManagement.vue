<template>
    <div>
        <v-container class="d-flex justify-center flex-column">
            <v-container class="d-flex justify-end">
                <v-btn prepend-icon="fa-solid fa-plus" class="bg-blue" :to="{name:'register-account'}">
                    Add Account
                </v-btn>
            </v-container>
            <UserAccountsTable/>
        </v-container>
    </div>
</template>
<script>
import { defineComponent } from 'vue';

// components
import UserAccountsTable from '../../../components/admin/tables/UserAccountsTable.vue'

export default defineComponent({
    name:'UserManagement',
    components:{
        UserAccountsTable
    }
})
</script>
<style>
    
</style>