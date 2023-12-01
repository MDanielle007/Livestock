<template>
    <v-app-bar
            color="teal-darken-4"
            :image="require('@/assets/images/appbar-bg.jpg')"
        >
            <template v-slot:image>
                <v-img
                    gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)"
                ></v-img>
            </template>

            <template v-slot:append>
                <v-menu>
                    <template v-slot:activator="{ props }">
                    <v-btn icon="fa-solid fa-bars" v-bind="props"></v-btn>
                    </template>

                    <v-list>
                        <v-list-item prepend-icon="fa-solid fa-arrow-right-from-bracket" density="compact" @click="logOut">
                            Log out
                        </v-list-item>
                    </v-list>
                </v-menu>
            </template>

            <v-app-bar-title>
                {{ this.$route.name }}
            </v-app-bar-title>

            <template v-if="shouldShowTabs" v-slot:extension>
                <v-tabs
                v-model="tab"
                grow
                stacked
                centered
                >
                    <v-tab value="one">
                        <v-icon class="mb-2">
                            fa-solid fa-cow
                        </v-icon>
                        <small>Livestock</small>
                    </v-tab>
                    <v-tab value="two">
                        <v-icon class="mb-2">
                            fa-solid fa-syringe
                        </v-icon>
                        <small>Vaccination</small>
                    </v-tab>
                    <v-tab value="three">
                        <v-icon class="mb-2">
                            fa-solid fa-heart
                        </v-icon>
                        <small>Breeding</small>
                    </v-tab>
                    <v-tab value="four">
                        <v-icon class="mb-2">
                            fa-solid fa-book-skull
                        </v-icon>
                        <small>Mortality</small>
                    </v-tab>
                    
                </v-tabs>
            </template>
    </v-app-bar>
</template>
<script>
import { clearToken } from '@/utils/cookieUtils';
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
    },
    methods:{
        logOut(){
            clearToken();
            
            this.$router.push('/login');
        }
    }
}
</script>
<style>
    
</style>