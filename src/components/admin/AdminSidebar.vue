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
            <v-list-item>
                <v-list-item 
                    prepend-icon="fa-solid fa-house " 
                    value="dashboard" :to="{name:'admin-dashboard'}"  
                    :class="{ 'active-item': $route.name === 'admin-dashboard' }"
                    class="text-subtitle-1" 
                    >Dashboard
                </v-list-item>
            </v-list-item>
            
            <v-list-item>
                <v-list-item
                    prepend-icon="fa-solid fa-cow" 
                    value="livestock-management" 
                    :to="{name:'admin-livestock-monitoring'}" 
                    :class="{ 'active-item': $route.name === 'admin-livestock-monitoring' }" 
                    @click="expand = !expand"
                    class="text-subtitle-1"     
                >
                Livestock Monitoring
                </v-list-item>

                <v-expand-transition>
                    <v-list v-show="expand" nav density="compact"
                        class="ml-13" >
                        <v-list-item 
                            class=" text-subtitle-2 rounded ma-1"
                            :to="{name:'admin-livestock-management'}" 
                            :class="{ 'active-item': $route.name === 'admin-livestock-management' }" >
                            Livestock Management
                        </v-list-item>
                        <v-list-item 
                            class=" text-subtitle-2 rounded ma-1"
                            :to="{name:'admin-vaccination-monitoring'}" 
                            :class="{ 'active-item': $route.name === 'admin-vaccination-monitoring' }">
                            Vaccination Monitoring
                        </v-list-item>
                        <v-list-item 
                            class=" text-subtitle-2 rounded ma-1"
                            :to="{name:'admin-breeding-monitoring'}" 
                            :class="{ 'active-item': $route.name === 'admin-breeding-monitoring' }">
                            Breeding Monitoring
                        </v-list-item>
                        <v-list-item
                            class=" text-subtitle-2 rounded ma-1"
                            :to="{name:'admin-mortality-monitoring'}" 
                            :class="{ 'active-item': $route.name === 'admin-mortality-monitoring' }">
                            Mortality Monitoring
                        </v-list-item>
                    </v-list>
                </v-expand-transition>
            </v-list-item>

            <v-list-item>
                <v-list-item prepend-icon="fa-solid fa-chart-simple" 
                value="reporting-analytics" 
                :to="{name:'admin-report-analytics'}" 
                :class="{ 'active-item': $route.name === 'admin-report-analytics' }" 
                >Reporting and Analytics</v-list-item>
            </v-list-item>

            <v-list-item>
                <v-list-item prepend-icon="fa-solid fa-scroll" 
                 value="audit-trail" 
                :to="{name:'admin-audit-trail'}" 
                :class="{ 'active-item': $route.name === 'admin-audit-trail' }" 
                >Audit Trail</v-list-item>
            </v-list-item>

            <v-list-item>
                <v-list-item prepend-icon="fa-solid fa-bullhorn" 
                value="reporting-analytics" 
                :to="{name:'admin-livestock-advisories'}" 
                :class="{ 'active-item': $route.name === 'admin-livestock-advisories' }" 
                >Livestock Advisories</v-list-item>
            </v-list-item>

            <v-list-item>
                <v-list-item prepend-icon="fa-solid fa-users" 
                 value="users" 
                :to="{name:'admin-user-management'}" 
                :class="{ 'active-item': $route.name === 'admin-user-management' }" 
                >User Management</v-list-item>
            </v-list-item>
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
            expand: false,
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