<template>
    <v-card class="mx-auto w-100 h-100 pa-5" title="Register New Account">
        <v-form fast-fail @submit.prevent="registerDA">
            <v-row no-gutters>
                <v-col cols="9">
                    <v-sheet class="pa-2 ma-2">
                        <v-row>
                            <v-col cols="6">
                                <v-text-field
                                    v-model="Username"
                                    variant="outlined"
                                    label="Username"
                                    
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field
                                    v-model="Password"
                                    variant="outlined"
                                    label="Password"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="4">
                                <v-text-field
                                    v-model="Firstname"
                                    variant="outlined"
                                    label="First name"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <v-text-field
                                    v-model="Middlename"
                                    variant="outlined"
                                    label="Middle name"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <v-text-field
                                    v-model="Lastname"
                                    variant="outlined"
                                    label="Last name"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col cols="3">
                                <v-text-field
                                    v-model="Date_Of_Birth"
                                    variant="outlined"
                                    label="Date Of Birth"
                                    type="date"

                                ></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-select
                                v-model="Gender"
                                variant="outlined"
                                label="Gender"
                                :items="['Male', 'Female', 'Other']"
                                ></v-select>
                            </v-col>
                            <v-col cols="3">
                                <v-select
                                v-model="Civil_Status"
                                variant="outlined"
                                label="Civil Status"
                                :items="['Single','Married','Widowed','Divorced']"
                                ></v-select>
                            </v-col>
                            <v-col cols="3">
                                <v-select
                                v-model="User_Role"
                                variant="outlined"
                                label="User Role"
                                :items="['Farmer','DA Personnel']"
                                ></v-select>
                            </v-col>
                        </v-row>
                    </v-sheet>
                </v-col>

                <v-col cols="3">
                    <v-sheet class="pa-2 ma-2 h-75 d-flex justify-center flex-column">
                        <v-img
                        class="mb-3 mx-auto"
                        width="200"
                        :aspect-ratio="1"
                        :src="
                            ($refs.FileInput &&
                            $refs.FileInput.getObjectURL(
                                selectedFile1[0]
                            )) ||
                            require('@/assets/img/default-picture.jpg')
                        "
                        ></v-img>
                        <FileUploadButton
                            v-model="selectedFile1"
                            @update:value="selectedFile1 = $event"
                            ref="FileInput"
                        />
                    </v-sheet>
                </v-col>
            </v-row>
            <v-row no-gutters>
                <v-col cols="12">
                    <v-sheet class="pa-2 ma-2">
                        <v-row>
                            <v-col cols="3">
                                <v-text-field
                                    v-model="Sitio"
                                    variant="outlined"
                                    label="Sitio"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field
                                    v-model="Barangay"
                                    variant="outlined"
                                    label="Barangay"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field
                                    v-model="City"
                                    variant="outlined"
                                    label="City"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field
                                    v-model="Province"
                                    variant="outlined"
                                    label="Province"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="4">
                                <v-text-field
                                    v-model="Phone_Number"
                                    variant="outlined"
                                    label="Phone Number"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="8">
                                <v-text-field
                                    v-model="Email"
                                    variant="outlined"
                                    label="Email Address"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="d-flex justify-end">
                            <v-col cols="2">
                                <v-btn type="submit" block class="mt-2">Submit</v-btn>
                            </v-col>
                            <v-col cols="2">
                                <v-btn
                                color="error"
                                block class="mt-2"
                                @click="resetForm"
                                >
                                Reset
                                </v-btn>
                            </v-col>
                            
                        </v-row>
                </v-sheet>
                </v-col>
            </v-row>
        </v-form>
    </v-card>
</template>

<script>
import axios from 'axios';
import { defineComponent } from 'vue';
import FileUploadButton from '@/components/buttons/FileUploadButton.vue';

export default defineComponent({
    name : 'RegisterFormDA',
    data: () => ({
        Username:'',
        Password:'',
        Firstname:'',
        Middlename:'',
        Lastname:'',
        Date_Of_Birth: null,
        Gender:'',
        User_Role:'',
        Civil_Status:'',
        Sitio:'',
        Barangay:'',
        City:'',
        Province:'',
        Phone_Number:'',
        Email:'',
        selectedFile1:''
    }),
    components:{
        FileUploadButton,
    },
    methods:{
        async registerDA(){
            try {
                const ins = await axios.post("admin/register",
                {
                    Username:this.Username,
                    Password:this.Password,
                    Firstname:this.Firstname,
                    Middlename:this.Middlename,
                    Lastname:this.Lastname,
                    Date_Of_Birth: this.Date_Of_Birth,
                    Gender:this.Gender,
                    Civil_Status:this.Civil_Status,
                    User_Role:this.User_Role,
                    Sitio:this.Sitio,
                    Barangay:this.Barangay,
                    City:this.City,
                    Province:this.Province,
                    Phone_Number:this.Phone_Number,
                    Email:this.Email,
                    Image:this.selectedFile1
                })
                console.log('Registration successful');
                console.log(ins);
            } catch (error) {
                // Registration failed, handle validation errors
                if (error.response.status === 400) {
                    this.errors = error.response.data;
                } else {
                    console.error('An error occurred:', error);
                }
            }
        },
        async resetForm(){
            this.Username = '';
            this.Password = '';
            this.Firstname = '';
            this.Middlename = '';
            this.Lastname = '';
            this.Date_Of_Birth = null;
            this.Gender = '';
            this.Civil_Status = '';
            this.User_Role = '';
            this.Sitio = '';
            this.Barangay = '';
            this.City = '';
            this.Province = '';
            this.Phone_Number = '';
            this.Email = '';
            this.selectedFile1 = '';
        },
        getObjectURL(file) {
            if (file) {
                return URL.createObjectURL(file);
            }
            return null;
        },
    }
});
</script>
<style>
    
</style>