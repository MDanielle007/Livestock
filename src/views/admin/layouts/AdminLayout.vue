<template>
    <div>
        <AdminAppBar/>
        <AdminSidebar/>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
import AdminAppBar from '@/components/admin/AdminAppBar.vue'
import AdminSidebar from '@/components/admin/AdminSidebar.vue'

export default {
    name:'admin-layout',
    components:{
        AdminAppBar,
        AdminSidebar
    }
}
</script>
<style>
    
</style>