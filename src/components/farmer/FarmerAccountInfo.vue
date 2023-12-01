<template>
    <v-card class="px-2">
        <v-list :items="basicInfo">
            <template v-slot:title="{ title }">
                <div v-html="title"></div>
            </template>
        </v-list>
    </v-card>
</template>
<script>
import { getCookie } from '@/utils/cookieUtils.js'
import { jwtDecode as jwt_decode } from 'jwt-decode';
import axios from 'axios'
export default {
    data(){
        return{
            username: '',
            userType: '',
            basicInfo: []
        }
    },
    methods:{
        async getAccountData() {
            try {
                // Fetch the token from the HTTP-only cookie
                const token = getCookie('token');

                const decodedToken = jwt_decode(token);

                const response = await axios.get(`farmer/getFarmerAccountData/${decodedToken.userid}`);
                const userData = response.data[0]; // Assuming the API response is an array with a single user data object

                // Update component data with API response
                this.username = userData.Username;
                this.userType = userData.User_Role;

                // Modify the basicInfo array based on the returned fields
                this.basicInfo = [
                    { title: `<span class="font-weight-bold">Username:</span> ${userData.Username}` },
                    { title: `<span class="font-weight-bold">Firstname:</span> ${userData.FirstName}` },
                    { title: `<span class="font-weight-bold">Middlename:</span> ${userData.MiddleName}` },
                    { title: `<span class="font-weight-bold">Lastname:</span> ${userData.Lastname}` },
                    { title: `<span class="font-weight-bold">Date of Birth:</span> ${userData.Date_Of_Birth}` },
                    { title: `<span class="font-weight-bold">Gender:</span> ${userData.Gender}` },
                    { title: `<span class="font-weight-bold">Civil Status:</span> ${userData.Civil_Status}` },
                    { title: `<span class="font-weight-bold">Address:</span> ${userData.Address}` }, // Use the Full_Address field from the API
                    { title: `<span class="font-weight-bold">Phone Number:</span> ${userData.Phone_Number}` },
                ];

                // Emit an event with the user data
                this.$emit('userDataUpdated', { username: this.username, userRole: this.userType, userProfile: userData.Image });
            } catch (error) {
                console.error("Error fetching account data:", error);
            }
        },
    },
    created() {
        // Call the function when the component is created
        this.getAccountData(); // You can replace 1 with the actual userID you want to fetch
    }
}
</script>
<style>
    
</style>