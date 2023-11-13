<template>
  <div>
    <v-stepper alt-labels :items="['Step 1', 'Step 2', 'Step 3']">
      <template v-slot:item.1>
        <v-card title="Step One" flat>
          <v-form @submit.prevent="submitStepOne">
            <v-text-field v-model="username" label="Username"></v-text-field>
            <v-text-field v-model="password" label="Password" type="password"></v-text-field>
            <v-text-field v-model="email" label="Email"></v-text-field>
            <!-- Add other fields for Step 1 -->
            <v-btn @click="nextStep(2)">Next</v-btn>
          </v-form>
        </v-card>
      </template>

      <template v-slot:item.2>
        <v-card title="Step Two" flat>
          <v-form @submit.prevent="submitStepTwo">
            <v-text-field v-model="firstname" label="First Name"></v-text-field>
            <v-text-field v-model="middlename" label="Middle Name"></v-text-field>
            <v-text-field v-model="lastname" label="Last Name"></v-text-field>
            <!-- Add other fields for Step 2 -->
            <v-btn @click="nextStep(3)">Next</v-btn>
          </v-form>
        </v-card>
      </template>

      <template v-slot:item.3>
        <v-card title="Step Three" flat>
          <v-form @submit.prevent="submitStepThree">
            <v-text-field v-model="dateOfBirth" label="Date of Birth" type="date"></v-text-field>
            <v-select v-model="gender" :items="['Male', 'Female']" label="Gender"></v-select>
            <v-select v-model="civilStatus" :items="['Single', 'Married', 'Divorced']" label="Civil Status"></v-select>
            <!-- Add other fields for Step 3 -->
          </v-form>
          
        </v-card>
      </template>
    </v-stepper>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  data() {
    return {
      username: '',
      password: '',
      email: '',
      firstname: '',
      middlename: '',
      lastname: '',
      dateOfBirth: '',
      gender: '',
      civilStatus: '',
      // Add other fields as needed
    };
  },
  methods: {
    submitStepOne() {
      // Handle Step 1 submission logic if needed
    },
    submitStepTwo() {
      // Handle Step 2 submission logic if needed
    },
    submitStepThree() {
      // Handle Step 3 submission logic if needed
    },
    nextStep(step) {
      // Add logic to navigate to the next step
    },
    submitForm() {
      // Handle overall form submission logic
    },
  },
});
</script>

<style>
  /* Add your custom styles here */
</style>
