<template>
    <v-layout class="h-100">
        <AdminAppbar/>
        <AdminSidebar/>
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-layout>
</template>
<script>
import { defineComponent } from 'vue';
import AdminAppbar from '../../../components/admin/AdminAppbar'
import AdminSidebar from '../../../components/admin/AdminSidebar'

export default defineComponent({
    name: 'admin-layout',
    components:{
        AdminAppbar,
        AdminSidebar
    }
})
</script>
<style>
    
</style>