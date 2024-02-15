<template>
    <v-dialog v-model="dialog" persistent width="1024">
        <template v-slot:activator="{ props }">
            <v-btn color="primary" prepend-icon="fa-solid fa-pen" v-bind="props" class="text-subtitle-1 rounded-lg"
                height="50" width="150">
                Compose
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="text-h5">Advisory Form</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row no-gutters>
                        <v-col>
                            <v-checkbox v-model="isGeneral" label="General Advisory"></v-checkbox>
                            <InputMultipleChips 
                            density="compact"
                            v-if="!isGeneral" 
                            :icon="'fa-solid fa-user'" 
                            @chips-updated="getTargetFarmer" 
                            :itemsProps="farmerNames"/>
                        </v-col>
                    </v-row>
                    <v-row no-gutters>
                        <v-col cols="12">
                            <v-text-field density="compact" label="Subject" required variant="outlined" v-model="advisorySubject">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea label="Content" variant="outlined" v-model="advisoryContent"></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                    Close
                </v-btn>
                <v-btn color="blue-darken-1" variant="text" @click="sendAdvisory">
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import InputMultipleChips from '@/components/general/inputs/InputMultipleChips.vue';
import axios from 'axios'

export default {
    data: () => ({
        dialog: false,
        targetFarmers:[],
        isGeneral:false,
        advisorySubject:'',
        advisoryContent:'',
        farmers: [],
        farmersData:[],
        farmerNames:[],
        targetFarmersIDs:[]
    }),
    components: {
        InputMultipleChips
    },
    methods:{
        getTargetFarmer(Farmers){
            this.targetFarmers = Farmers
        },
        async sendAdvisory(){
            try {
                const formData = new FormData();
                formData.append('IsGeneral',this.isGeneral)
                formData.append('targetFarmers', JSON.stringify(this.targetFarmersIDs))
                formData.append('Subject', this.advisorySubject)
                formData.append('Content',this.advisoryContent)

                const response = await axios.post('admin/createAdvisory',formData)
                console.log(response.data);
                this.closeForm()

            } catch (error) {
                console.log(error);   
            }
        },
        async getFarmers(){
            try {
                const response = await axios.get('getFarmerNames');
                this.farmersData = response.data;
                console.log(this.farmersData);
                this.farmerNames = this.farmersData.map(item => item.itemName)
                console.log(this.farmerNames);
            } catch (error) {
                console.log(error);
            }
        },
        closeForm(){
            this.isGeneral = false;
            this.targetFarmers = [];
            this.advisorySubject = '';
            this.advisoryContent = ''
            this.dialog = false
        }
    },
    created(){
        this.getFarmers()
    },
    watch:{
        targetFarmers(newTargets){
            console.log(newTargets);

            this.targetFarmersIDs = newTargets.flatMap(target =>
            this.farmersData
                .filter(farmer => farmer.itemName === target)
                .map(foundFarmer => foundFarmer.itemID)
            );

            console.log(this.targetFarmersIDs);
        },
        isGeneral(value){
            if(value === true){
                this.targetFarmers = []
            }
        }
    }
}
</script>
