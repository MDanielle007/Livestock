<template>
    <v-navigation-drawer
        v-model="drawer"
        :rail="rail"
        permanent
        @click="rail = false"
        style="font-family: 'Poppins', sans-serif; background-color: #F4F3F3; "
    >
        <v-list-item
            :class="{ 'active-item': $route.name === 'admin-dashboard' }"
            class="ml-2 "
            prepend-icon="fa-solid fa-user"
            title="Current User"
            nav
        >
            <template v-slot:append>
                <v-btn
                variant="text"
                icon="fa-solid fa-caret-left"
                @click.stop="rail = !rail"
                ></v-btn>
            </template>
        </v-list-item>
        
        <v-divider></v-divider>

        <v-list density="compact" nav >
            <v-list-item prepend-icon="fa-solid fa-house " value="dashboard" :to="{name:'admin-dashboard'}"  :class="{ 'active-item': $route.name === 'admin-dashboard' }" class="my-2" >Dashboard</v-list-item>
            <v-list-item prepend-icon="fa-solid fa-cow" title="Livestock Management" value="livestock-management" :to="{name:'admin-livestock-management'}" :class="{ 'active-item': $route.name === 'admin-livestock-management' }" class="my-2"></v-list-item>
            <v-list-item prepend-icon="fa-solid fa-chart-simple" title="Reporting and Analytics" value="reporting-analytics" :to="{name:'admin-report-analytics'}" :class="{ 'active-item': $route.name === 'admin-report-analytics' }" class="my-2"></v-list-item>
            <v-list-item prepend-icon="fa-solid fa-scroll" title="Audit Trail" value="audit-trail" :to="{name:'admin-audit-trail'}" :class="{ 'active-item': $route.name === 'admin-audit-trail' }" class="my-2"></v-list-item>
            <v-list-item prepend-icon="fa-solid fa-people-line" title="User Management" value="users" :to="{name:'admin-user-management'}" :class="{ 'active-item': $route.name === 'admin-user-management' }" class="my-2"></v-list-item>
            
        </v-list>
        <template v-slot:append>
            <v-list nav>
                <v-list-item prepend-icon="fa-solid fa-gear" title="Settings" value="settings" :class="{ 'active-item': $route.name === 'settings' }"></v-list-item>
            </v-list>
            <div class="pa-2">
                <v-btn block>
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
            rail: false,
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