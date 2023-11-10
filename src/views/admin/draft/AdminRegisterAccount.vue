<template>
    <v-layout class="h-100">
        <AdminAppbar/>
    
        <Sidebar/>
    
        <v-main>
            <RegisterFormDA/>
        </v-main>
    </v-layout>
</template>
<script>
import { defineComponent } from 'vue';
    // Components
import Sidebar from '@/components/Sidebar.vue'
import AdminAppbar from '@/components/AdminAppbar.vue';
import RegisterFormDA from '@/components/RegisterFormDA.vue';

export default defineComponent({
    name: 'AdminDashboard',

    components: {
        AdminAppbar,
        Sidebar,
        RegisterFormDA
    },
});
</script>
<style>
    
</style>