<template>
    <v-container>
        <v-row>
            <h1>Farmer Livestock</h1>
            <v-checkbox label="Checkbox" v-model="addMultiple"></v-checkbox>
        </v-row>
        <v-row>
            <CRUDLivestockTable/>
        </v-row>
    </v-container>
</template>

<!-- <script>
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
    name: 'Farmer Livestock',
    data() {
        return {
            headers: [
                { title: 'Livestock Type', align: 'end', key: 'Livestock_Type' },
                { title: 'Breed Name', align: 'end', key: 'Breed_Name' },
                { title: 'Age', align: 'end', key: 'Age' },
                { title: 'Sex', align: 'end', key: 'Sex' },
                { title: 'Date of Birth', align: 'end', key: 'Date_Of_Birth' },
            ],
            livestocks: [],
            addMultiple: true,
            livestock: {
                Livestock_Type: null,
                Breed_Name: '',
                Age: '',
                Sex: '',
                Date_Of_Birth: null,
            },
            livestocktypes:[],
            breednames:[],
            SexOption:['Male','Female']
        };
    },
    mounted() {
        this.getLivestockType(); // Call your function here
    },
    methods: {
        addLivestocks() {
           // Copy the livestock object to avoid a reference to the same object
            const newLivestock = { ...this.livestock };

            // Push the new livestock object into the livestocks array
            this.livestocks.push(newLivestock);

            // Clear the form fields for the next entry
            this.clearForm();

            console.log(this.livestocks);
            },

            clearForm() {
            // Clear all the fields in the livestock object
            for (const key in this.livestock) {
                this.livestock[key] = '';
            }
        },
        async getLivestockType() {
            try {
                const types = await axios.get('getLivestockTypes');
                this.livestocktypes = types.data;
            } catch (error) {
                console.log(error);
            }
        },
        async getLivestockBreed(typeName) {
            try {
                const types = await axios.get(`getLivestockBreed/${typeName}`);
                this.breednames = types.data;
                console.log(types);
            } catch (error) {
                console.log(error);
            }
        },
    },
    watch: {
        'livestock.Livestock_Type'(newValue) {
            console.log('Selected livestock type: ', newValue)
            this.getLivestockBreed(newValue)
        }
    }
});
</script> -->

<script>
import { defineComponent } from 'vue';
import CRUDLivestockTable from '@/components/farmer/tables/CRUDLivestockTable.vue';

export default defineComponent({
    name: 'FarmerLivestockManagement',
    components:{
        CRUDLivestockTable
    }
})
</script>
<style>
/* Add your styles here */
</style>
