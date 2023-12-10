<template>
    <div>
        <h1>Livestock Advisories</h1>
    </div>
    <div>
        <AdminAdvisories/>
    </div>
</template>
<script>
import AdminAdvisories from '@/components/admin/AdminAdvisories.vue';

export default {
    name: 'admin-livestock-advisories',
    components:{
        AdminAdvisories,
    }
}
</script>
<style>
    
</style>