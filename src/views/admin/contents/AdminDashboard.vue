<template>
    
    <areagraphmorelines/>

  <areagraph/>
  
  <piechart/>
 
  
</template>
<script>
import areagraph from '../../../components/admin/charts/areagraph.vue'
import areagraphmorelines from '../../../components/admin/charts/areagraphmorelines.vue'
import piechart from '../../../components/admin/charts/piechart.vue'


export default {
    name:'AdminDashboard',
    components:{
        areagraph,
        areagraphmorelines,
        piechart
    }
}
</script>
<style>
    
</style>