<template>
    <v-layout class="d-flex flex-column h-screen">
        <v-row class="d-flex align-center justify-center h-100">
            <v-col cols="7" class="h-100 bg-amber d-none d-md-flex">

            </v-col>
            <v-col sm="12" md="5" class=" h-100 d-flex align-center">
                <v-container class="mx-auto pa-10">
                    <div class="text-h1">
                        hello
                    </div>
                    <v-form fast-fail @submit.prevent="loginUser">
                        <v-text-field v-model="username" label="User Name"></v-text-field>

                        <v-text-field 
                            v-model="password" 
                            label="password"
                            :type="isPasswordVisible ? 'text' : 'password'"
                            :append-inner-icon="isPasswordVisible ? 'mdi:mdi-eye-off-outline' : 'mdi:mdi-eye-outline'"
                            @click:append-inner="isPasswordVisible = !isPasswordVisible"
                        ></v-text-field>
                        <a href="#" class="text-body-2 font-weight-regular">Forgot Password?</a>

                        <v-btn type="submit" color="primary" block class="mt-2">Sign in</v-btn>

                    </v-form>
                    <div class="mt-2">
                        <p class="text-body-2">Don't have an account? <a href="#">Sign Up</a></p>
                    </div>
                </v-container>
            </v-col>
        </v-row>
        <v-row class="px-4 pb-2">
            <v-footer>{{ new Date().getFullYear() }} — <strong>Vuetify</strong></v-footer>
        </v-row>
    </v-layout>
</template>

<script>
import axios from 'axios';
import { defineComponent } from 'vue';
import { jwtDecode as jwt_decode } from 'jwt-decode';

export default defineComponent({
    name: 'LoginView',
    data: () =>{
        return{
            username : '',
            password: '',
            isPasswordVisible : false
        }
    },
    methods:{
        async loginUser(){
            try {
                const response = await axios.post("/loginAuth",{
                    Username:this.username,
                    Password:this.password
                })

                const decodedToken = jwt_decode(response.data.token);
                const userRole = decodedToken.aud;

                // Use more secure storage like HttpOnly cookies instead of localStorage
                document.cookie = `token=${response.data.token}; HttpOnly`
                
                switch (userRole) {
                    case 'Farmer':
                        this.$router.push('/farmer/home');
                        break;
                    case 'DAP':
                        this.$router.push('/admin/dashboard');
                        break;
                    // Handle other roles if needed
                    default:
                        this.$router.push('/login');
                }
            } catch (error) {
                console.error("Error during login:", error);
                // Handle errors more explicitly, show user-friendly messages if needed
            }
        }
    }
})
</script>
