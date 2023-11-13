<template>
    <v-container>
        <v-form @submit.prevent="addLivestocks">
        <v-row>
            <v-col cols="12" md="6">
                <v-text-field v-model="livestock.Livestock_Type" label="Livestock Type"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="livestock.Breed_Name" label="Breed Name"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="livestock.Age" label="Age"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="livestock.Sex" label="Sex"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="livestock.Date_Of_Birth" label="Date of Birth"></v-text-field>
            </v-col>
        </v-row>

        <v-btn type="submit" color="primary">Add Livestock</v-btn>
        </v-form>
    </v-container>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    data() {
        return {
        livestock: {
            Livestock_Type: '',
            Breed_Name: '',
            Age: '',
            Sex: '',
            Date_Of_Birth: '',
        },
        };
    },
    methods: {
        addLivestocks() {
            
        },
    },
});
</script>
