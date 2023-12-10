<template>
    <v-sheet class="bg-indigo-accent-1 rounded-t-xl d-flex align-center justify-end px-8" height="80">
        <AdvisoryForm :icon="'fa-solid fa-user'" />
    </v-sheet>
    <v-list lines="three" height="480" class="rounded-b-xl">
        <v-list-item-group v-if="livestockAdvisories.length > 0">
            <v-list-item v-for="(item, index) in livestockAdvisories" :key="index" v-lazy @click="openNotifications(item)">
                <template v-slot:prepend>
                    <v-avatar>
                        <v-img :src="getImagePath(item.Is_General)" alt="Type Image" />
                    </v-avatar>
                </template>
                <!-- Display your item data here -->
                <v-list-item-content>
                    <v-list-item-title><strong>{{ item.Subject }}</strong></v-list-item-title>
                    <v-list-item-subtitle>{{ item.Content }} <br> <small>{{ item.Date_Published
                    }}</small></v-list-item-subtitle>
                </v-list-item-content>
                <v-divider v-if="index !== livestockAdvisories.length - 1"></v-divider>

                <v-dialog v-model="advisoryDialog" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5">
                            {{ selectedAdvisory.Subject }}
                        </v-card-title>
                        <v-card-text>
                            {{ selectedAdvisory.Content }}
                        </v-card-text>
                        <v-card-actions>
                            <v-btn color="primary" block @click="advisoryDialog = false">Close Dialog</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-list-item>
        </v-list-item-group>
        <v-list-item v-else>
            <v-list-item-content>No data available</v-list-item-content>
        </v-list-item>
    </v-list>
</template>
  
<script>
import axios from 'axios';
import AdvisoryForm from './forms/AdvisoryForm.vue';

export default {
    data: () => ({
        livestockAdvisories: [],
        isLoading: false,
        error: null,
        advisoryDialog: false,
        selectedAdvisory: {
            Subject: '',
            Content: '',
        }
    }),
    components: {
        AdvisoryForm
    },
    methods: {
        async getLivestockAdvisories() {
            try {
                this.isLoading = true;
                const response = await axios.get('admin/getAdvisories');
                this.livestockAdvisories = response.data;
            } catch (error) {
                console.error(error);
                this.error = 'An error occurred while fetching data.';
            } finally {
                this.isLoading = false;
            }
        },
        getImagePath(type) {
            if (type === '1') {
                return require('@/assets/images/advisories/icons8-global-96.png')
            } else {
                return require('@/assets/images/advisories/icons8-farmer-96.png')
            }
        },
        openNotifications(item) {
            console.log(item);
            this.selectedAdvisory.Subject = item.Subject
            this.selectedAdvisory.Content = item.Content
            console.log(this.selectedAdvisory);
            this.advisoryDialog = true
        }
    },
    created() {
        this.getLivestockAdvisories();
    },
};
</script>
  
<style>
/* Add your styles here if needed */
</style>
  