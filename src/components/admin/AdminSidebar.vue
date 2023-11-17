<template>
    <v-navigation-drawer
        v-model="drawer"
        :permanent="isLargeScreen"
        style="font-family: 'Poppins', sans-serif; background-color: #F4F3F3; "
    >
        <v-list-item
            :class="{ 'active-item': $route.name === 'admin-dashboard' }"
            class="ml-2 "
            prepend-icon="fa-solid fa-user"   
            nav
        >
            Current User
        </v-list-item>
        
        <v-divider></v-divider>

        <v-list density="compact" nav >
            <v-list-item prepend-icon="fa-solid fa-house " 
                value="dashboard" :to="{name:'admin-dashboard'}"  
                :class="{ 'active-item': $route.name === 'admin-dashboard' }" 
                class="my-2" >Dashboard
            </v-list-item>

            <v-list-item prepend-icon="fa-solid fa-cow" 
                 value="livestock-management" 
                :to="{name:'admin-livestock-management'}" 
                :class="{ 'active-item': $route.name === 'admin-livestock-management' }" 
                class="my-2">Livestock Management</v-list-item>

            <v-list-item prepend-icon="fa-solid fa-chart-simple" 
                value="reporting-analytics" 
                :to="{name:'admin-report-analytics'}" 
                :class="{ 'active-item': $route.name === 'admin-report-analytics' }" 
                class="my-2">Reporting and Analytics</v-list-item>

            <v-list-item prepend-icon="fa-solid fa-scroll" 
                 value="audit-trail" 
                :to="{name:'admin-audit-trail'}" 
                :class="{ 'active-item': $route.name === 'admin-audit-trail' }" 
                class="my-2">Audit Trail</v-list-item>

            <v-list-item prepend-icon="fa-solid fa-people-line" 
                 value="users" 
                :to="{name:'admin-user-management'}" 
                :class="{ 'active-item': $route.name === 'admin-user-management' }" 
                class="my-2">User Management</v-list-item>
            
        </v-list>
        <template v-slot:append>
            <v-list nav>
                <v-list-item prepend-icon="fa-solid fa-gear" title="Settings" value="settings" :class="{ 'active-item': $route.name === 'settings' }"></v-list-item>
            </v-list>
            <div class="pa-2">
                <v-btn block @click="logout">
                Logout
                </v-btn>
            </div>
        </template>
    </v-navigation-drawer>
</template>
<script>
export default {
    data () {
        return {
            drawer: true,
            isLargeScreen: true,
        }
    },
    mounted() {
        this.checkScreenSize();
        window.addEventListener("resize", this.checkScreenSize);
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.checkScreenSize);
    },
    methods: {
        checkScreenSize() {
            // Adjust the screen size threshold as needed
            this.isLargeScreen = window.innerWidth >= 768; // Example threshold: 768 pixels
        },
        logout(){
            // Clear the session storage
            sessionStorage.removeItem('token'); // Replace 'yourTokenKey' with the actual key used for storing the JWT token
            
            // Redirect to the login page or any desired destination
            this.$router.push('/login');
        }
    },
}
</script>
<style scoped>
.active-item {
  background-color: #FFFFFF;
  color: #344767;
  
}
</style>