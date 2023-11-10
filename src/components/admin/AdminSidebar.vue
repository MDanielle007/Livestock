<template>
    <v-navigation-drawer
        v-model="drawer"
        :rail="rail"
        permanent
        @click="rail = false"
    >
        <v-list-item
            class="ml-2"
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

        <v-list density="compact" nav>
            <v-list-item prepend-icon="fa-solid fa-house " value="dashboard" :to="{name:'admin-dashboard'}">Dashboard</v-list-item>
            <v-list-item prepend-icon="fa-solid fa-cow" title="Livestock Management" value="livestock-management" :to="{name:'admin-livestock-management'}"></v-list-item>
            <v-list-item prepend-icon="fa-solid fa-chart-simple" title="Reporting and Analytics" value="reporting-analytics" :to="{name:'admin-report-analytics'}"></v-list-item>
            <v-list-item prepend-icon="fa-solid fa-scroll" title="Audit Trail" value="audit-trail" :to="{name:'admin-audit-trail'}"></v-list-item>
            <v-list-item prepend-icon="fa-solid fa-people-line" title="User Management" value="users" :to="{name:'admin-user-management'}"></v-list-item>
        </v-list>
        <template v-slot:append>
            <v-list nav>
                <v-list-item prepend-icon="fa-solid fa-gear" title="Settings" value="settings"></v-list-item>
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