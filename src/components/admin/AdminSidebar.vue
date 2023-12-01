<template>
    <v-navigation-drawer
        v-model="drawer"
        :permanent="isLargeScreen"
        width="300"
        
    >
        <v-list-item
             height="70">
            <v-img 
            height="55"
            width="55"
            :src="require('@/assets/images/3HEADS OUTLINE.png')"
            ></v-img>
        </v-list-item>

        <v-list-item
            class="ml-2"
            prepend-icon="fa-solid fa-user"   
            nav
        >
        
            Current User
        </v-list-item>
        
      

        <v-list density="compact" nav >
            <v-list-item prepend-icon="fa-solid fa-house " 
                    value="dashboard" :to="{name:'admin-dashboard'}"  
                    :class="{ 'active-item': $route.name === 'admin-dashboard' }" 
                
                    >Dashboard
            </v-list-item>

            <v-list-item prepend-icon="fa-solid fa-cow" 
                 value="livestock-management" 
                :to="{name:'admin-livestock-management'}" 
                :class="{ 'active-item': $route.name === 'admin-livestock-management' }" 
                >Livestock Management</v-list-item>

            <v-list-item prepend-icon="fa-solid fa-chart-simple" 
                value="reporting-analytics" 
                :to="{name:'admin-report-analytics'}" 
                :class="{ 'active-item': $route.name === 'admin-report-analytics' }" 
                >Reporting and Analytics</v-list-item>

            <v-list-item prepend-icon="fa-solid fa-scroll" 
                 value="audit-trail" 
                :to="{name:'admin-audit-trail'}" 
                :class="{ 'active-item': $route.name === 'admin-audit-trail' }" 
                >Audit Trail</v-list-item>

            <v-list-item prepend-icon="fa-solid fa-users" 
                 value="users" 
                :to="{name:'admin-user-management'}" 
                :class="{ 'active-item': $route.name === 'admin-user-management' }" 
                >User Management</v-list-item>
            
        </v-list>
        <template v-slot:append>
            <div class="pa-6">
                <v-btn block style="background: linear-gradient(to right, #0164a5, #142195, #142195, #0164a5); color: white;" @click="logout">
                Logout
                </v-btn>
            </div>
        </template>
    </v-navigation-drawer>
</template>
<script>
import { clearToken } from '@/utils/cookieUtils';
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
            clearToken();
            
            // Redirect to the login page or any desired destination
            this.$router.push('/login');
        }
    },
}
</script>
<style scoped>
.active-item {
    background-color: white;
    color: #142195;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
    
}
</style>