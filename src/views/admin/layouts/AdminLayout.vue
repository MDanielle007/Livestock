<template>
    <v-layout class="h-100">
        <AdminAppbar @closeSidebar="handleCloseSidebar"/>
        <AdminSidebar
            v-model="drawerVisible"
        />
        <v-main>
           <v-container>
            <router-view></router-view>
           </v-container>
        </v-main>
    </v-layout>
</template>
<script>
import { defineComponent } from 'vue';
import AdminAppbar from '../../../components/admin/AdminAppbar'
import AdminSidebar from '../../../components/admin/AdminSidebar'

export default defineComponent({
    name: 'admin-layout',
    data(){
        return {
            drawerVisible: true
        }
    },
    components:{
        AdminAppbar,
        AdminSidebar
    },
    methods:{
        handleCloseSidebar(isClose){
            this.drawerVisible = isClose;
        }
    }
})
</script>
<style>
    
</style>