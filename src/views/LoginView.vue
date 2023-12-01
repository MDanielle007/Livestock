<template>
    <v-layout class="d-flex flex-column h-screen">
        <v-row class="d-flex align-center justify-center h-100">
            <v-col cols="8" class="h-100 d-none d-md-flex" >
                <v-img
                :width="300"
                aspect-ratio="16/9"
                cover
                :src="require('@/assets/images/BG-SOLID-CENTER.jpg')"
            ></v-img>
            </v-col>
            
            <v-col sm="12" md="4" class=" h-100 d-flex pt-16">
                <v-container class="px-10" >
                    <div class="d-flex d-md-none justify-center">
                        <v-img
                        height="140"
                        :src="require('@/assets/images/3HEADS OUTLINE.png')"></v-img>
                    </div>
                    <div class=" text-center text-indigo-darken-4 font-weight-bold" style="font-size: 40px;">
                        Welcome Back!
                    </div>
                    <div class=" text-center mb-16 text-indigo-darken-4" style="font-size: 18px;">
                        We're thrilled to see you again!
                    </div>
                    <v-form fast-fail @submit.prevent="loginUser">
                        <v-text-field v-model="username" variant="outlined" label="Username" ></v-text-field>

                        <v-text-field 
                            v-model="password" 
                            label="Password"
                            variant="outlined"
                            :type="isPasswordVisible ? 'text' : 'password'"
                            :append-inner-icon="isPasswordVisible ? 'mdi:mdi-eye-off-outline' : 'mdi:mdi-eye-outline'"
                            @click:append-inner="isPasswordVisible = !isPasswordVisible"
                        ></v-text-field>
                        <a href="#" class="text-body-3 font-weight-regular float-right" style="text-decoration: none; color: navy; " >Forgot Password?</a>

                        <v-btn type="submit" color="primary" block class="mt-16" size="large">Sign in</v-btn>

                        <v-alert 
                            v-if="errorMessage" 
                            type="error" 
                            class="mt-4 " 
                            variant="tonal"
                            border="start"
                        >
                            {{ errorMessage }}
                        </v-alert>
                    </v-form>
                    
                </v-container>
            </v-col>
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
            isPasswordVisible : false,
            errorMessage: ''
        }
    },
    methods:{
        async loginUser(){
            try {
                const response = await axios.post("/loginAuth",{
                    Username:this.username,
                    Password:this.password
                })

                if(!response.data.login){
                    // response.data.error // this contains an error message that says "Invalid username or password" 
                    this.errorMessage = response.data.error;
                    this.password = ''
                }else{
                    const decodedToken = jwt_decode(response.data.token);
                    const userRole = decodedToken.aud;

                    console.log(userRole);

                    // Set the token as an HTTP-only cookie with an expiration time
                    this.setCookie('token', response.data.token, 1); // 1 day expiration
                    
                    switch (userRole) {
                        case 'Farmer':
                            this.$router.push({name:'Farmer Dashboard'});
                            break;
                        case 'DA Personnel':
                            this.$router.push({name:'admin-dashboard'});
                            break;
                        // Handle other roles if needed
                        default:
                            this.$router.push('/login');
                    }
                }
            } catch (error) {
                console.error("Error during login:", error);
            }
        },
        // Helper function to set HTTP-only cookie
        setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }
    }
})
</script>
