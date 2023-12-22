<template>
	<div>
		<v-sheet class="bg-teal-darken-1 rounded-t-xl" height="60">
			<v-img :src="require('@/assets/images/bg/another-bg.jpg')" cover gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)" class="rounded-t-xl" ></v-img>
		</v-sheet>
		<v-list lines="three" class="rounded-b-xl pa-3 h-screen">
			<v-list-item-group v-if="farmerNotification.length > 0">
				<v-list-item v-for="(item, index) in farmerNotification" :key="index" v-lazy class="rounded-xl"
					@click="openNotification(item)">
					<template v-slot:prepend>
						<v-avatar>
							<v-img :src="getImagePath(item.Is_General)" alt="Type Image" />
						</v-avatar>
					</template>
					
					<v-list-item-content>
						<v-list-item-title><strong>{{ item.Subject }}</strong></v-list-item-title>
						<v-list-item-subtitle>{{ item.Content }} <br> <small>{{ item.Date_Published
						}}</small></v-list-item-subtitle>
					</v-list-item-content>
					<v-divider v-if="index !== farmerNotification.length - 1"></v-divider>
				</v-list-item>
				<v-dialog v-model="notificationDialog" max-width="500px">
					<v-card height="300">
						<v-card-title class="text-h5">
							{{ selectedNotification.Subject }}
						</v-card-title>
						<v-card-text>
							{{ selectedNotification.Content }}
						</v-card-text>
						<v-card-actions>
							<v-btn color="primary" block @click="notificationDialog = false">Close Dialog</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-list-item-group>
			<v-list-item v-else>
				<v-list-item-content>No data available</v-list-item-content>
			</v-list-item>
		</v-list>
	</div>
</template>
<script>
import axios from 'axios'
import { getCookie } from '@/utils/cookieUtils.js'
import { jwtDecode as jwt_decode } from 'jwt-decode';

export default {
	data: () => ({
		notificationSnackbar: true,
		farmerNotification: [],
		userid: '',
		isLoading: false,
		error: null,
		notificationDialog: false,
		selectedNotification: {
			Subject: '',
			Content: '',
		},
		pollInterval: null,
		showAlert: true,
	}),
	methods: {
		async getFarmerNotification() {
			try {
				this.isLoading = true;
				const response = await axios.get(`farmer/getFarmerNotification/${this.userid}`);
				this.farmerNotification = response.data;
			} catch (error) {
				console.error(error);
				this.error = 'An error occurred while fetching data.';
			} finally {
				this.isLoading = false;
			}
		},
		openNotification(item) {
			console.log(item);
			this.selectedNotification.Subject = item.Subject;
			this.selectedNotification.Content = item.Content;
			this.notificationDialog = true
		},
		startPolling() {
			// Set up polling at an interval (e.g., every 5 seconds)
			this.pollInterval = setInterval(() => {
				this.getFarmerNotification();
			}, 5000); // Change this interval to your desired polling frequency
		},
		stopPolling() {
			// Clear the interval to stop polling
			clearInterval(this.pollInterval);
		},
		getImagePath(type) {
            if (type === '1') {
                return require('@/assets/images/advisories/icons8-global-96.png')
            } else {
                return require('@/assets/images/advisories/icons8-farmer-96.png')
            }
        },
	},
	created() {
		const token = getCookie('token');

		const decodedToken = jwt_decode(token);

		this.userid = decodedToken.userid

		this.getFarmerNotification();

		// Start polling when the component is created
		this.startPolling();
	},
	beforeDestroy() {
		this.stopPolling();
	},

}
</script>