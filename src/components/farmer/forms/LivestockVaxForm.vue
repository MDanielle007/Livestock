<template>
    <v-dialog
        v-model="dialog"
        persistent
        width="1024"
    >
        <template v-slot:activator="{ props }">
        <v-btn
            v-bind="props"
            variant="plain"
            prepend-icon="fa-solid fa-syringe"
        >
        Add Vaccine
        </v-btn>
        </template>
        <v-card>
        <v-card-title>
            <span class="text-h5">Livestock Vaccine Form</span>
        </v-card-title>
        <v-card-text>
            <v-container>
            <v-row >
                <v-col cols="4">
                    <v-text-field
                        label="Vaccine Name"
                        v-model="vaccinationName"
                    ></v-text-field>
                </v-col>

                <v-col cols="4">
                    <v-text-field
                        label="Vaccination Date"
                        type="date"
                        v-model="vaccinationDate"
                    ></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-textarea
                        label="Vaccine Description"
                        v-model="vaccinationDescription"
                    ></v-textarea>
                </v-col>
            </v-row>
            </v-container>
            <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
            color="blue-darken-1"
            variant="text"
            @click="dialog = false"
            >
            Close
            </v-btn>
            <v-btn
            color="blue-darken-1"
            variant="text"
            @click="addLivestockVax"
            >
            Save
            </v-btn>
        </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import axios from 'axios'

export default {
    props: {
        livestockData: Object, // Define the prop type
    },
    data: () => ({
        dialog: false,
        vaccinationName:'',
        vaccinationDescription:'',
        vaccinationDate: new Date().toISOString().substr(0, 10),
    }),
    created() {
        
    },
    methods: {
        async addLivestockVax(){
            const formData = new FormData()
            formData.append('vaccinationName',this.vaccinationName)
            formData.append('vaccinationDescription',this.vaccinationDescription)
            formData.append('vaccinationDate',this.vaccinationDate)
            formData.append('livestockID',this.livestockData.Livestock_ID)
            // console.log(formData);
            // console.log(this.vaccineName);
            // console.log(this.vaccinationDate);
            // console.log(this.vaccineDescription);
            // console.log(this.livestockData.Livestock_ID);

            const response = await axios.post('farmer/administerVaccine',formData);
            console.log(response);
        }
    },
}
</script>