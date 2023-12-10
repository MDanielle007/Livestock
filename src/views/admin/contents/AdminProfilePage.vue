<template>
    <div class="bg-red">
        <v-card class="mt-3" width="auto" height="650">
        <div class="pa-4 relative-position">
          <v-img class="rounded-lg" src="https://picsum.photos/350/165?random" height="150" cover></v-img>
  
          <div class="bg-secondary rounded-circle w-100">
            <v-avatar size="120" class="avatar-position">
                <v-img  class="rounded-img" src="@/assets/images/3HEADS CIRCLE.png" alt="Descriptive Text for Image"></v-img>
              </v-avatar>
          </div>
        </div>
  
        <v-row class="justify-end mr-10 mt-1">
          <v-btn class="color= bg-indigo-darken-4">Edit Profile</v-btn>
        </v-row>
  
        <div class="text-h5 mt-10 ml-5 font-weight-bold">Personal Information</div>
  
        <div class="mt-3">
          <v-row no-gutters >
            <v-col cols="12" sm="3">
                <v-text-field density="compact" width="auto" class="ma-1 pa-2 " v-model="userId" label="User ID" variant="outlined"></v-text-field>
              </v-col>
              <v-col cols="12" sm="3">
                <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="username" label="Username" variant="outlined"></v-text-field>
              </v-col>
              <v-col cols="12" sm="3">
                <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="password" label="Password" variant="outlined"></v-text-field>
              </v-col>
              <v-col cols="12" sm="3">
                <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="email" label="Email" variant="outlined"></v-text-field>
              </v-col>
            </v-row>
         <v-row no-gutters>
            <v-col cols="2.4" >
              <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="firstname" label="Firstname" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="2.4" >
              <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="lastname" label="Lastname" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="2.4" >
              <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="dob" label="Date of Birth" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="2.4" >
              <v-select density="compact" width="auto" class="ma-1 pa-2" v-model="gender" label="Gender" :items="genderOptions" variant="outlined"></v-select>
            </v-col>
            <v-col cols="2.4" >
              <v-select density="compact" width="auto" class="ma-1 pa-2" v-model="civilStatus" label="Civil Status" :items="civilStatusOptions" variant="outlined"></v-select>
            </v-col>
        </v-row>
        <v-row no-gutters>
            <v-col cols="12" sm="3">
              <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="sitio" label="Sitio" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" sm="3">
              <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="barangay" label="Barangay" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" sm="3">
              <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="city" label="City" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" sm="3">
              <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="province" label="Province" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" sm="3">
              <v-text-field density="compact" width="auto" class="ma-1 pa-2" v-model="phoneNumber" label="Phone Number" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" sm="3">
              <v-text-field density="compact" width="auto" class="ma-1 pa-2 border-" v-model="position" label="Position" variant="outlined" ></v-text-field>
            </v-col>
            <v-col class="d-flex justify-end mr-10 mt-10">
                <div >
                    <v-btn class="color= bg-indigo-darken-4 ">Save</v-btn>
                </div>
            </v-col>
          </v-row>
          
        </div>
      </v-card>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        userId: '',
        username: '',
        password: '',
        email: '',
        firstname: '',
        lastname: '',
        dob: '',
        gender: '',
        civilStatus: '',
        sitio: '',
        barangay: '',
        city: '',
        province: '',
        phoneNumber: '',
        position: '',
        genderOptions: ['Male', 'Female'],
        civilStatusOptions: ['Single', 'Married', 'Divorced', 'Widowed'],
      };
    },
  };
  </script>
  
  <style scoped>
  .relative-position {
    position: relative;
  }
  .avatar-position {
    position: absolute;
    bottom: -50px; /* Half the avatar's size to make it center */
    left: 40px;
  }
  .rounded-img {
     /* This sets the border color to white and width to 3px */
    border-radius: 50%; /* This will give you a completely rounded border */
    background: #ffffff; /* Optional: Adds a subtle shadow to lift the image off the page */
  }
  </style>
  