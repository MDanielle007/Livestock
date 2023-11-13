<template>
    <v-form @submit.prevent="addLivestocks">
        <v-row>
            <v-col cols="12" md="6">
                <v-select
                    label="Livestock Type"
                    :items="livestocktypes"
                    v-model="livestock.Livestock_Type"
                ></v-select>
            </v-col>
            <v-col>
                <v-select
                    label="Breed"
                    :items="breednames"
                    v-model="livestock.Breed_Name"
                ></v-select>
            </v-col>
        </v-row>
    </v-form>
</template>
<script>
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
    name:'AddLivestocksForm',
    data(){
        return {
            livestock:{
                Livestock_Type:'',
                Breed_Name:'',
                Age:'',
                Sex:'',
                Date_Of_Birth:''
            },
            livestocktypes:[],
            breednames:[],
            sex:['Male','Female'],
        }
    },
    methods:{
        addLivestock(){
            this.$emit('addLivestock',{...this.livestock});
            this.clearForm();
        },
        clearForm(){
            for(const key in this.livestock){
                this.livestock[key] = '';
            }
        },
        async getLivestockTypes(){
            try{
                const response = await axios.get('/getLivestocktypes');
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
        }
    },
    mounted(){
        this.getLivestockTypes();
    },
    watch:{
        'livestock.Livestock_Type'(newValue){
            console.log(newValue);
            this.getLivestockBreeds(newValue)
        }
    }
})
</script>
<style>
    
</style>