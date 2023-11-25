<template>
    <v-row justify="center">
        <v-dialog
            v-model="dialog"
            persistent
            width="1024"
        >
            <template v-slot:activator="{ props }">
            <v-btn
                color="primary"
                v-bind="props"
            >
                New Livestock
            </v-btn>
            </template>
            <v-card>
            <v-card-title>
                <span class="text-h5">Livestock Details</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                <v-row>
                    <v-col cols="12" md="5">
                        <v-select
                            label="Livestock Type"
                            :items="livestocktypes"
                            v-model="livestock.Livestock_Type"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" md="5">
                        <v-select
                            label="Breed"
                            :items="breednames"
                            v-model="livestock.Breed_Name"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-select
                            label="Sex"
                            :items="['Male','Femal']"
                            v-model="livestock.Sex"
                        ></v-select>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="6" lg="3">
                        <v-select
                            label="Livestock Age Classification"
                            :items="ageClass"
                            v-model="livestock.Age_Class"
                        ></v-select>
                    </v-col>
                    
                    <v-col cols="12" md="2">
                        <v-text-field
                            :label="activeAgeInput > 1 ? 'Age in Days':'Livestock Age'"
                            v-model="livestock.AgeDays"
                        ></v-text-field>
                    </v-col>
                    <v-col v-if="activeAgeInput > 1" cols="12" md="2">
                        <v-text-field
                            label="Age in Weeks"
                            v-model="livestock.AgeWeeks"
                        ></v-text-field>
                    </v-col>
                    <v-col v-if="activeAgeInput > 2" cols="12" md="2">
                        <v-text-field
                            label="Age in Months"
                            v-model="livestock.AgeMonths"
                        ></v-text-field>
                    </v-col>
                    <v-col v-if="activeAgeInput > 3" cols="12" md="2">
                        <v-text-field
                            label="Age in Years"
                            v-model="livestock.AgeYears"
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" md="2">
                        <v-select
                        label="Age Based on"
                        :items="['Days','Weeks','Months','Years']"
                        v-model="AgeBasedOn"
                        ></v-select>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-text-field
                            type="date"
                            label="Date Of Birth"
                            v-model="livestock.Date_Of_Birth"
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field
                            type="date"
                            label="Acquired Date"
                            v-model="livestock.Date_Acquired"
                        ></v-text-field>
                    </v-col>

                </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                color="blue-darken-1"
                variant="text"
                @click="resetInputs"
                >
                Close
                </v-btn>
                <v-btn
                color="blue-darken-1"
                variant="text"
                @click="AddLivestockRecord"
                >
                Save
                </v-btn>
            </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
import axios from 'axios'

export default {
    data: () => ({
        dialog: false,

        livestock:{
            Livestock_Type:'',
            Breed_Name:'',
            AgeDays:'',
            AgeWeeks:'',
            AgeMonths:'',
            AgeYears:'',
            Age_Class:'',
            Sex:'',
            Date_Of_Birth:new Date().toISOString().substr(0, 10),
            Date_Acquired:new Date().toISOString().substr(0,10),
        },
        livestocktypes:[],
        breednames:[],
        ageClass:[],
        activeAgeInput: 1,
        AgeBasedOn:'',
        sex:['Male','Female'],
    }),
    methods:{
        async getLivestockTypes(){
            try{
                const response = await axios.get('getLivestockTypes');
                this.livestocktypes = response.data;
            }catch(error){
                console.log(error);
            }
        },

        async getLivestockBreeds(typename){
            try {
                const response = await axios.get(`/getLivestockBreed/${typename}`);
                this.breednames = response.data;
            } catch (error) {
                console.log(error);
            }
        },

        async getLivestockAgeClass(typename){
            try {
                const response = await axios.get(`/getLivestockAgeClass/${typename}`);
                this.ageClass = response.data;
            } catch (error) {
                console.log(error);
            }
        },

        async AddLivestockRecord(){
            console.log(this.livestock);
            const formData = new FormData();
            formData.append('Farmer_ID','1')
            formData.append('Acquired_Date',this.livestock.Date_Acquired)
            formData.append('Livestock_Type',this.livestock.Livestock_Type)
            formData.append('Breed_Name',this.livestock.Breed_Name)
            formData.append('Age_Classification',this.livestock.Age_Class)
            formData.append('Age_Days',this.livestock.AgeDays)
            formData.append('Age_Weeks',this.livestock.AgeWeeks)
            formData.append('Age_Months',this.livestock.AgeMonths)
            formData.append('Age_Years',this.livestock.AgeYears)
            formData.append('Sex',this.livestock.Sex)
            formData.append('Date_Of_Birth', this.livestock.Date_Of_Birth)

            const response = await axios.post('farmer/addLivestock', formData)

            this.$emit('livestockAdded');
            console.log(response);
            this.resetInputs();
        },

        resetInputs(){
            this.livestock.Livestock_Type = '',
            this.livestock.Breed_Name = '',
            this.livestock.AgeDays = '',
            this.livestock.AgeWeeks = '',
            this.livestock.AgeMonths = '',
            this.livestock.AgeYears = '',
            this.livestock.Age_Class = '',
            this.livestock.Sex = '',
            this.livestock.Date_Of_Birth = new Date().toISOString().substr(0, 10),
            this.livestock.Date_Acquired = new Date().toISOString().substr(0,10),
            
            this.dialog = false
        }
    },
    mounted(){
        this.getLivestockTypes();
    },
    watch:{
        'livestock.Livestock_Type'(newValue){
            console.log(newValue);
            this.getLivestockBreeds(newValue)
            this.getLivestockAgeClass(newValue)
        },
        'AgeBasedOn'(newAgeBasedOn) {
            // Add your logic here to handle changes in AgeBasedOn
            console.log('AgeBasedOn changed:', newAgeBasedOn);

            // For example, you might want to perform some actions when AgeBasedOn changes
            // You can call a method or update other data properties based on the new value.

            // If AgeBasedOn is 'SomeValue', do something
            if (newAgeBasedOn === 'Weeks') {
                // Your logic here
                this.activeAgeInput = 2
            }else if(newAgeBasedOn === 'Months'){
                this.activeAgeInput = 3
            }else if(newAgeBasedOn === 'Years'){
                this.activeAgeInput = 4
            }
        },
    }
}
</script>