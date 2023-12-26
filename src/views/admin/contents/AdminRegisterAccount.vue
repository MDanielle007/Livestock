<template>
    <div>
        <div class="d-flex justify-space-between">
            <h1>Register Account</h1>
            <v-btn variant="tonal" class="secondary" prepend-icon="fa-solid fa-caret-left" @click="this.$router.go(-1);">Back</v-btn>
        </div>
        <RegisterForm/>
    </div>
</template>
<script>
import RegisterForm from '../../../components/admin/forms/RegisterForm'

export default {
    name:'Register Account Page',
    components:{
        RegisterForm
    }
}
</script>
<style>
    
</style>