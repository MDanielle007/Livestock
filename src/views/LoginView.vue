<template>
    <v-layout class="hero">
        <v-container class="h-screen d-flex align-center justify-center">
            <v-sheet class="bg-red-accent-2 h-75 w-75 rounded-xl" elevation="5">
                <v-row class="ma-0 h-100">
                    <v-col class="h-100 sideImg rounded-s-xl">

                    </v-col>
                    <v-col class="bg-grey-lighten-5 pa-0 rounded-e-xl">
                        <v-form @submit.prevent="loginUser">
                            <div class="bg-green-accent-3 px-10 py-5 rounded-te-xl">
                                <h1>Livestock Outlook</h1>
                            </div>
                            <v-container class="px-5 py-5">
                                <h2 class="mb-3">Login</h2>
                                <v-text-field v-model="username" label="Username"></v-text-field>

                                <v-text-field v-model="password" label="Password"></v-text-field>
                                <v-row class="d-flex align-center mt-5">
                                    <v-col>
                                        <a>
                                            Forgot Password?
                                        </a>
                                    </v-col>
                                    <v-col>
                                        <v-btn type="submit" block class="mt-2 pa-5 bg-green-accent-3">Login</v-btn>
                                    </v-col>
                                    
                                </v-row>
                            </v-container>
                        </v-form>
                    </v-col>
                </v-row>
            </v-sheet>
        </v-container>
    </v-layout>
</template>
<script>
import axios from 'axios';
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'LoginView',
    data: () =>{
        return{
            username : '',
            password: '',
        }
    },
    methods:{
        async loginUser(){
            try {
                const user = await axios.post("/loginAuth",{
                    username:this.username,
                    passsword:this.passsword
                })

            } catch (error) {
                console.log(error);
            }
        }
    }
})
</script>
