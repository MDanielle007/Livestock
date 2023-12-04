<template>
    <v-card>
        <v-sheet class="d-flex flex-column align-center justify-center pt-10">
            <v-avatar :image="userProfile || require('@/assets/images/default-picturejpg.jpg')" size="200"></v-avatar>
            <v-list class="d-flex flex-column align-center">
                <v-list-item><h2>{{ username }}</h2></v-list-item>
                <v-list-item>
                    <v-chip color="green">{{ userType }}</v-chip>
                </v-list-item>
            </v-list>
        </v-sheet>
        <v-divider></v-divider>
        <v-tabs
      v-model="tab"
      bg-color="deep-purple-accent-4"
      centered
      grow
    >
      <v-tab value="tab-1">
        <v-icon class="mr-2">fa-solid fa-user-large</v-icon>
        Account Info
      </v-tab>

      <v-tab value="tab-2">
        <v-icon class="mr-2">fa-solid fa-cow</v-icon>
        Farm
      </v-tab>
    </v-tabs>
    <v-window v-model="tab">
      <v-window-item
        value="tab-1"
      >
        <FarmerAccountInfo @userDataUpdated="handleUserDataUpdated"/>
      </v-window-item>
    </v-window>
    </v-card>
</template>
<script>
import axios from 'axios';
import FarmerAccountInfo from '@/components/farmer/FarmerAccountInfo.vue'

export default {
    data() {
        return {
            username: '',
            userType: '',
            userProfile: null,
            tab: null,
        };
    },
    methods: {
        handleUserDataUpdated(userData) {
            // Access the updated user data from the child component
            const { username, userRole, userProfile } = userData;

            // Do something with the data, e.g., assign it to a property in the parent component
            this.username = username;
            this.userType = userRole;
            this.userProfile = userProfile
        },
    },
    components:{
        FarmerAccountInfo
    }
};
</script>

<style>
    
</style>