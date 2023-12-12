<template>
    <v-dialog v-model="dialog" persistent width="500">
        <template v-slot:activator="{ props }">
            <v-btn 
            color="primary" 
            v-bind="props" 
            prepend-icon="fa-solid fa-arrow-up-from-bracket"
            variant="tonal">
                Import
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="text-h5">Import Livestock Data</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-file-input label="File input" v-model="file"></v-file-input>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                    Close
                </v-btn>
                <v-btn color="blue-darken-1" variant="text" @click="uploadCSV">
                    Import
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import axios from 'axios'
export default {
    props:{
        uploadTo: String,
        userId: String,
    },
    data: () => ({
        dialog: false,
        file: '',
    }),
    methods:{
    async uploadCSV(){
      try{
        const formData = new FormData()
        formData.append('file',this.file[0],this.file[0].name)
        formData.append('userId',this.userId)
          const response = await axios.post('importCsvToDbLivestock',formData)
          console.log(response);
        console.log(this.userId);
        this.file = ''
        this.dialog = false;
      }catch(error){
        console.log(error);
      }
    }
  }
}
</script>