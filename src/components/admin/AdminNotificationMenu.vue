<template>
    <v-menu transition="slide-y-transition">
        <template v-slot:activator="{ props }">
            <v-btn color="white" v-bind="props" variant="plain">
                <v-icon>fa-solid fa-bell</v-icon>
            </v-btn>
        </template>
            <v-list lines="two" width="400" height="550" class="rounded-lg" v-lazy>
                <v-list-item-group v-if="dataHistory.length > 0">
                    <v-list-item v-for="(item, index) in dataHistory" :key="index" v-lazy>
                        <template v-slot:prepend>
                            <v-avatar>
                                <v-img :src="getImagePath(item.Type)" alt="Type Image" />
                            </v-avatar>
                        </template>
                        <!-- Display your item data here -->
                        <v-list-item-content>
                            <v-list-item-title><strong>{{ item.Title }}</strong></v-list-item-title>
                            <v-list-item-subtitle>{{ item.Description }} <br> <small>{{ item.Timestamp
                            }}</small></v-list-item-subtitle>
                        </v-list-item-content>
                        <v-divider v-if="index !== dataHistory.length - 1"></v-divider>
                    </v-list-item>
                </v-list-item-group>
                <v-list-item v-else>
                    <v-list-item-content>No data available</v-list-item-content>
                </v-list-item>
            </v-list>
    </v-menu>
</template>
<script>
import axios from 'axios';

export default {
  data: () => ({
    dataHistory: [],
    isLoading: false,
    error: null,
  }),
  methods: {
    async getFarmerDataHistory() {
      try {
        this.isLoading = true;
        const response = await axios.get(`admin/getDataHistory`);
        this.dataHistory = response.data;
      } catch (error) {
        console.error(error);
        this.error = 'An error occurred while fetching data.';
      } finally {
        this.isLoading = false;
      }
    },
    getImagePath(type) {
      switch (type) {
        case 'Livestock':
          return require('@/assets/images/datahistory/icons8-cow-96.png');
        case 'Vaccination':
          return require('@/assets/images/datahistory/icons8-vaccine-96.png');
        case 'Breeding':
          return require('@/assets/images/datahistory/icons8-heart-96.png');
        case 'Mortality':
          return require('@/assets/images/datahistory/icons8-dead-chicken-96.png');
        default:
          return ''; // You can provide a default image path if needed
      }
    },
    startPolling() {
			// Set up polling at an interval (e.g., every 5 seconds)
			this.pollInterval = setInterval(() => {
				this.getFarmerDataHistory();
			}, 5000); // Change this interval to your desired polling frequency
		},
		stopPolling() {
			// Clear the interval to stop polling
			clearInterval(this.pollInterval);
		},
  },
  created() {
    this.getFarmerDataHistory();

    // Start polling when the component is created
		this.startPolling();
  },
  beforeDestroy() {
		this.stopPolling();
	},
};
</script>
<style></style>