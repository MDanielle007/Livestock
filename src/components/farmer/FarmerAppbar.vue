<template>
    <v-app-bar
            color="teal-darken-4"
            image="https://picsum.photos/1920/1080?random"
        >
            <template v-slot:image>
            <v-img
                gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)"
            ></v-img>
            </template>

            <template v-slot:prepend>
            <v-app-bar-nav-icon></v-app-bar-nav-icon>
            </template>

            <v-app-bar-title>
                {{ this.$route.name }}
            </v-app-bar-title>

            <template v-if="shouldShowTabs" v-slot:extension>
                <v-tabs
                v-model="tab"
                grow
                >
                    <v-tab value="one">Livestock Management</v-tab>
                    <v-tab value="two">Vaccination Records</v-tab>
                    <v-tab value="three">Mortality Records</v-tab>
                </v-tabs>
            </template>
    </v-app-bar>
</template>
<script>

export default {
    name:'FarmerAppBar',
    data() {
        return {
        }
    },
    computed: {
        // Compute whether to show the tabs based on the current route
        shouldShowTabs() {
            return this.$route.name === 'Farmer Livestocks';
        },
        tab: {
            get() {
                return this.$store.state.activeTab;
            },
            set(tab) {
                this.$store.commit('tabs/setTab', tab);
            },
        },
    }
}
</script>
<style>
    
</style>