<template>
    <v-card class="pa-5">
        <h2>Livestock Breeding Form</h2>
        <v-row dense="true">
            <v-col cols="6">
                <ListLivestocksDialog 
                    ref="maleLivestocksDialog"
                    :labelText="'Male'" 
                    :livestocksListItems="this.maleLivestocks" 
                    @livestock-selected="handleLivestockSelectedMale" 
                    @livestock-selectedID="handleLivestockSelectedMaleID"
                    />
            </v-col>
            <v-col cols="6">
                <ListLivestocksDialog 
                    ref="femaleLivestocksDialog"
                    :labelText="'Female'" 
                    :livestocksListItems="this.femaleLivestocks" 
                    @livestock-selected="handleLivestockSelectedFemale"
                    @livestock-selectedID="handleLivestockSelectedFemaleID"/>
            </v-col>
            <v-col cols="12" sm="6">
                <v-text-field label="Breeding Results" variant="outlined" v-model="breedResult"></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
                <v-text-field label="Date" type="date" variant="outlined" v-model="breedDate"></v-text-field>
            </v-col>
            <v-col cols="12">
                <v-textarea label="Notes" variant="outlined" v-model="breedNotes"></v-textarea>
            </v-col>
        </v-row>
        <v-row>
            <v-col class="d-flex align-center justify-center">
                <v-btn color="primary" @click="breedSubmit">Breed Livestock</v-btn>
            </v-col>
        </v-row>
    </v-card>
</template>
<script>
import axios from 'axios';
import ListLivestocksDialog from '../ListLivestocksDialog.vue';
import { getCookie } from '@/utils/cookieUtils.js'
import { jwtDecode as jwt_decode } from 'jwt-decode';

export default {
    data(){
        return{
            userid:'',
            selectedMaleID:'',
            selectedFemaleID:'',
            selectedMale:'',
            selectedFemale:'',
            breedResult:'',
            breedDate: new Date().toISOString().substr(0, 10),
            breedNotes:'',
            maleLivestocks: [],
            femaleLivestocks: [],
        }
    },
    components:{
        ListLivestocksDialog
    },
    methods:{
        async getBreedingLivestocks(){
            try {
                const token = getCookie('token');

                const decodedToken = jwt_decode(token);

                this.userid = decodedToken.userid

                const response = await axios.get(`getLivestockForBreeding/${this.userid}`)
                this.maleLivestocks = response.data.livestocks.maleLivestocks
                this.femaleLivestocks = response.data.livestocks.femaleLivestocks
            } catch (error) {
                console.log(error);
            }
        },
        handleLivestockSelectedMale(livestockTagID) {
            // Update selectedLivestock when a v-list-item is clicked
            this.selectedMale = livestockTagID;
        },
        handleLivestockSelectedFemale(livestockTagID) {
            // Update selectedLivestock when a v-list-item is clicked
            this.selectedFemale = livestockTagID;
        },
        handleLivestockSelectedMaleID(livestockID){
            this.selectedMaleID = livestockID
        },
        handleLivestockSelectedFemaleID(livestockID){
            this.selectedFemaleID = livestockID
        },
        async breedSubmit(){
            try {
                const formData = new FormData();
                formData.append('farmerID',1),
                formData.append('maleLivestockID',this.selectedMaleID)
                formData.append('femaleLivestockID',this.selectedFemaleID)
                formData.append('maleLivestock',this.selectedMale)
                formData.append('femaleLivestock',this.selectedFemale)
                formData.append('breedResult',this.breedResult)
                formData.append('breedNotes',this.breedNotes)
                formData.append('breedDate',this.breedDate)

                const response = await axios.post('farmer/recordBreeding',formData)
                console.log(response.data);

                // Clear the text field in ListLivestocksDialog component
                this.$refs.maleLivestocksDialog.clearTextField();
                this.$refs.femaleLivestocksDialog.clearTextField();

                this.resetInputs();
            } catch (error) {
                console.log(error);
            }
        },
        resetInputs(){
            this.selectedMaleID=''
            this.selectedFemaleID=''
            this.selectedMale=''
            this.selectedFemale=''
            this.breedResult=''
            this.breedDate= new Date().toISOString().substr(0, 10)
            this.breedNotes=''
        }
    },
    created(){
        this.getBreedingLivestocks();
    }
}
</script>
<style>
    
</style>