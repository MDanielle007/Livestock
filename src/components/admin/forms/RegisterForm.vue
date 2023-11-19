<template>
    <v-stepper
        v-model="step"
        :items="items"
        show-actions
    >
        <template v-slot:item.1>
            <h3 class="text-h6">Personal Information</h3>
            
            <v-container>
                <v-row>
                    <v-col cols="12" sm="4">
                        <v-text-field 
                        v-model="Firstname" 
                        label="Firstname" 
                        variant="outlined"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="4">
                        <v-text-field 
                        v-model="Middlename" 
                        label="Middlename" 
                        variant="outlined"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="4">
                        <v-text-field 
                        v-model="Lastname" 
                        label="Lastname" 
                        variant="outlined"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="4" lg="3">
                        <v-text-field 
                        label="Date of Birth" 
                        variant="outlined" 
                        type="date"
                        v-model="dateOfBirth"
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="4" lg="3">
                        <v-select
                        v-model="Gender"
                        label="Gender"
                        variant="outlined"
                        :items="['Male', 'Female', 'Other',]"
                        ></v-select>
                    </v-col>
                    
                    <v-col cols="12" sm="6" md="4" lg="3">
                        <v-select
                        v-model="CivilStatus"
                        label="Civil Status"
                        variant="outlined"
                        :items="['Single', 'Married', 'Widowed','Divorced']"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" sm="6" md="4" lg="3">
                        <v-select
                        label="User Type"
                        variant="outlined"
                        :items="['DA Personnel', 'Farmer', 'Care Taker']"
                        v-model="userType"
                        ></v-select>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6" md="4" lg="3">
                        <v-text-field 
                            label="Province"
                            variant="outlined"
                            v-model="Province"
                            ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4" lg="3">
                        <v-text-field 
                            label="City"
                            variant="outlined"
                            v-model="City"
                            ></v-text-field>    
                    </v-col>
                    <v-col cols="12" sm="6" md="4" lg="3">
                        <v-text-field 
                            label="Barangay"
                            variant="outlined"
                            v-model="Barangay"
                            ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4" lg="3">
                        <v-text-field 
                            label="Sitio"
                            variant="outlined"
                            v-model="Sitio"
                            ></v-text-field>    
                    </v-col>
                </v-row>
            </v-container>

        </template>
    
        <template v-slot:item.2>
            <h3 class="text-h6">Account Information</h3>
            
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <v-text-field 
                        label="Username" 
                        variant="outlined"
                        v-model="Username"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field 
                        label="Email" 
                        variant="outlined"
                        v-model="Email"></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field 
                            label="Password"
                            variant="outlined"
                            v-model="Password"
                            ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field 
                            label="Confirm Password"
                            variant="outlined"
                            v-model="ConfirmPassword"
                            ></v-text-field>    
                    </v-col>
                </v-row>
            </v-container>
        </template>

        <template v-slot:item.3>
            <h3 class="text-h6">Additional Information</h3>
            <v-row>
                    <v-col cols="12" sm="3">
                        <v-img
                            class="mb-3"
                            :aspect-ratio="1"
                            :src="
                                ($refs.FileInput &&
                                $refs.FileInput.getObjectURL(
                                    selectedFile[0]
                                )) ||
                                require('@/assets/images/default-picturejpg.jpg')
                            "
                            ></v-img>
                            <FileUploadInput
                                v-model="selectedFile"
                                @update:value="selectedFile = $event"
                                ref="FileInput"
                            />
                    </v-col>
                    <v-col cols="12" md="9" class="d-flex flex-column">
                        <div v-if="TypeFarmer">
                            <v-text-field 
                            label="Years of Farming" 
                            variant="outlined"
                            v-model="YearsFarming"
                            ></v-text-field>
                        </div>
                        <div v-if="!TypeFarmer">
                            <v-text-field 
                            label="Division" 
                            variant="outlined"
                            v-model="Division"
                            ></v-text-field>
                            <v-text-field 
                            label="Position" 
                            variant="outlined"
                            v-model="Position"
                            ></v-text-field>
                        </div>
                        <div>
                            <v-text-field 
                            label="ContactNumber" 
                            variant="outlined"
                            v-model="Phone_Number"
                            ></v-text-field>
                        </div>
                    </v-col>
                </v-row>
        </template>
        <template v-slot:item.4>
            <h3 class="text-h6">Confirm Registration</h3>
            <div class="d-flex align-center">
                <v-checkbox
                v-model="termsPolicy"
                value="success"
                color="success"
                class="ma-5"
                ></v-checkbox>
                <p class="ml-5">
                    By checking this box, I confirm that I have read and agree to the [Terms of Service] and [Privacy Policy]. I also acknowledge that I am responsible for understanding and complying with the provided terms and policies.
                </p>
            </div>

            <div class="pa-10 d-flex ga-4 justify-center">
                <v-btn 
                size="large" 
                color="#5865f2" 
                variant="elevated"
                :disabled="!termsPolicy"
                @click="registerUser"
                >Register User</v-btn>
                <v-btn @click="resetBtn" size="large" color="#CF6679" variant="outlined">Reset Form</v-btn>
            </div>
            
        </template>
    </v-stepper>
</template>
<script>
import FileUploadInput from '@/components/general/inputs/FileUploadInput.vue';
import axios from 'axios';

export default {
    data() {
        return{
            Username:'',
            Password:'',
            ConfirmPassword:'',
            Firstname:'',
            Middlename:'',
            Lastname:'',
            dateOfBirth: null,
            Gender:'',
            CivilStatus:'',
            Sitio:'',
            Barangay:'',
            City:'',
            Province:'',
            Phone_Number:'',
            Email:'',
            userType:'',
            selectedFile:'',
            YearsFarming:'',
            Division:'',
            Position:'',
            TypeFarmer: false,
            termsPolicy: false,

            step: 1,
            items: [
                'Personal Information',
                'Account Information',
                'Additional Information',
                'Confirm Registration',
            ],
        }
        
    },
    computed: {
    },
    watch:{
        'userType'(newValue){
            console.log(newValue);
            if(newValue === 'Farmer' || newValue === 'Care Taker'){
                this.TypeFarmer = true
            }else{
                this.TypeFarmer = false
            }
        },
        'dateOfBirth'(newValue){
            console.log(newValue);
        }
    },
    components:{
        FileUploadInput
    },
    methods:{
        getObjectURL(file) {
            if (file) {
                return URL.createObjectURL(file);
            }
            return null;
        },
        async resetBtn(){
            this.step = 1
            this.Username=''
            this.Password=''
            this.Firstname=''
            this.Middlename=''
            this.Email=''
            this.ConfirmPassword=''
            this.Lastname=''
            this.dateOfBirth= null
            this.Gender=''
            this.CivilStatus=''
            this.Sitio=''
            this.Barangay=''
            this.City=''
            this.Province=''
            this.Phone_Number=''
            this.Email=''
            this.userType=""
            this.termsPolicy=false
            this.selectedFile=''
        },
        async registerUser(){
            console.log("Register User");
            const formData = new FormData();
            formData.append('file', this.selectedFile[0], this.selectedFile[0].name);
            formData.append('Username', this.Username);
            formData.append('Password', this.Password);
            formData.append('Email', this.Email);
            formData.append('Firstname', this.Firstname);
            formData.append('Middlename', this.Middlename);
            formData.append('Lastname', this.Lastname);
            formData.append('Date_Of_Birth', this.dateOfBirth);
            formData.append('Gender', this.Gender);
            formData.append('Civil_Status',this.CivilStatus);
            formData.append('Sitio',this.Sitio);
            formData.append('Barangay', this.Barangay);
            formData.append('City', this.City);
            formData.append('Province', this.Province);
            formData.append('Phone_Number', this.Phone_Number);
            formData.append('User_Role', this.userType);
            formData.append('Position', this.Position);
            formData.append('Division', this.Division);
            formData.append('YearsFarming', this.YearsFarming);

            
            console.log(formData.values);
            // Make the Axios request to your backend
            try {
                const response = await axios.post("admin/registerUserAccount", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
                })
                console.log('Headers:', axios.defaults.headers);
                console.log('Request Data:', formData);

                console.log(response);
            } catch (error) {
                console.log(error);
            }

            console.log(this.selectedFile);
        }
    }
}
</script>