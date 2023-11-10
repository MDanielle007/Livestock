<template>
    <v-navigation-drawer
        v-model="drawer"
        :rail="rail"
        permanent
        @click="rail = false"
        theme = "dark"
    >
        <v-list-item
            class="ml-2"
            prepend-icon="mdi-account-circle"
            title="Current User"
            nav
        >
            <template v-slot:append>
                <v-btn
                variant="text"
                icon="mdi-chevron-left"
                @click.stop="rail = !rail"
                ></v-btn>
            </template>
        </v-list-item>

        <v-divider></v-divider>

        <v-list density="compact" nav>
            <v-list-item prepend-icon="mdi-home" title="Home" value="dashboard" to="/farmer"></v-list-item>
            <v-list-item prepend-icon="mdi-barn" title="Livestock" value="livestock-management" to="/farmer/livestock-management"></v-list-item>
            <v-list-item prepend-icon="mdi-cart" title="Sales" value="reporting-analytics" to="/farmer/sales"></v-list-item>
            <v-list-item prepend-icon="mdi-bell" title="Notification" value="notifications" to="/farmer/notifications"></v-list-item>
            <v-list-item prepend-icon="mdi-account-circle" title="Account" value="account" to="/farmer/account"></v-list-item>
        </v-list>
        <template v-slot:append>
            <v-list nav>
                <v-list-item prepend-icon="mdi-cog" title="Settings" value="settings"></v-list-item>
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