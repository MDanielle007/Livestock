<template>
    <v-layout class="h-100" style="background-color: #F9FBFD">
        <AdminSidebar
            v-model="drawerVisible"
            style="position: fixed;"
        />
        <AdminAppbar @closeSidebar="handleCloseSidebar" style="position: fixed;"/>
        
        <v-main>
           <v-container>
                <router-view></router-view>
           </v-container>
           <v-footer>{{ new Date().getFullYear() }} — <strong>Vuetify</strong></v-footer>
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