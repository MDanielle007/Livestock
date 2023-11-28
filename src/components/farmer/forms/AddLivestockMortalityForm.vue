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
            prepend-icon="fa-solid fa-book-skull"
        >
        Report Mortality
        </v-btn>
        </template>
        <v-card>
        <v-card-title>
            <span class="text-h5">Livestock Mortality Form</span>
        </v-card-title>
        <v-card-text>
            <v-container>
            <v-row>
                <v-col>
                    <v-text-field
                    label="Livestock Type"
                    v-model="livestockData.livestockType"
                    readonly
                    ></v-text-field>
                </v-col>
                <v-col>
                    <v-text-field
                    label="Livestock Type"
                    v-model="livestockData.LivestockTagID"
                    readonly
                    ></v-text-field>
                </v-col>
                <v-col>
                    <v-text-field
                    label="Date of Death"
                    v-model="dateOfDeath"
                    type="date"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-textarea
                label="Cause of Death"
                v-model="causeOfDeath"
                ></v-textarea>
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
            @click="reportMortality"
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
        dateOfDeath: new Date().toISOString().substr(0, 10),
        causeOfDeath:'',
    }),
    methods:{
        async reportMortality(){
            console.log(this.livestockData.Livestock_ID);
            console.log(this.dateOfDeath);
            console.log(this.causeOfDeath);

            const formData = new FormData();
            formData.append('livestockID', this.livestockData.Livestock_ID)
            formData.append('dateOfDeath', this.dateOfDeath)
            formData.append('causeOfDeath', this.causeOfDeath)
            formData.append('Farmer_ID','1')
            formData.append('LivestockTagID',this.livestockData.LivestockTagID)

            const response = await axios.post('farmer/addLivestockMortality',formData)
            this.$emit('livestockAdded');
            console.log(response.data.message);
            this.resetInputs()
        },

        resetInputs(){
            this.causeOfDeath = '';
            this.dateOfDeath = new Date().toISOString().substr(0, 10);
            this.dialog = false
        }
    }
}
</script>