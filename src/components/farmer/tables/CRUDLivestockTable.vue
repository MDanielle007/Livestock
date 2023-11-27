<template>
    <v-data-table-server
        :headers="headers"
        :items="livestocks"
        :sort-by="[{ key: 'livestockType', order: 'asc' }]"
        @update:selection="onSelectionUpdate"
        v-model="selectedLivestocks"
        show-select
        item-value="Livestock_ID"
        :items-per-page="itemsPerPage"
    >
        <template v-slot:top>
            <v-toolbar
                flat
                >
                <v-toolbar-title>Livestocks</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog
                    v-model="dialog"
                    max-width="800px"
                >
                    <v-card>
                    <v-card-title>
                        <span class="text-h5">{{ formTitle }}</span>
                    </v-card-title>
        
                    <v-card-text>
                        <v-container>
                        <v-row>
                            <v-col
                                cols="12"
                                >
                                <v-text-field
                                    variant="outlined"
                                    v-model="editedItem.LivestockTagID"
                                    label="Livestock Tag ID"
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="5"
                                >
                                <v-text-field
                                    variant="outlined"
                                    v-model="editedItem.livestockType"
                                    label="Livestock Type"
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="5"
                                >
                                <v-text-field
                                    variant="outlined"
                                    v-model="editedItem.breedName"
                                    label="Livestock Type"
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="2"
                                >
                                <v-select
                                    variant="outlined"
                                    :items="['Male','Female']"
                                    v-model="editedItem.sex"
                                    label="Sex"
                                ></v-select>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                                >
                                <v-text-field
                                    variant="outlined"
                                    v-model="editedItem.ageClass"
                                    label="Age Classification"
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                                >
                                <v-text-field
                                    variant="outlined"
                                    v-model="editedItem.age"
                                    label="Age"
                                ></v-text-field>
                            </v-col>
                            
                            
                        </v-row>
                        </v-container>
                    </v-card-text>
        
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="close"
                        >
                        Cancel
                        </v-btn>
                        <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="save"
                        >
                        Save
                        </v-btn>
                    </v-card-actions>
                    </v-card>
                </v-dialog>
                
                <NewLivestockForm @livestockAdded="getFarmerLivestock"/>

                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                    <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancel</v-btn>
                        <v-btn color="blue-darken-1" variant="text" @click="deleteItemConfirm">OK</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-menu>
                <template v-slot:activator="{ props }">
                <v-btn icon="fa-solid fa-ellipsis-vertical" v-bind="props" variant="plain"></v-btn>
                </template>
                <v-list>
                    <v-list-item>
                        <LivestockVaxForm :livestockData="item"/>
                    </v-list-item>
                    <v-list-item>
                        <LivestockMortalityForm :livestockData="item" @livestockAdded="getFarmerLivestock"/>
                    </v-list-item>
                    <v-list-item>
                        <v-btn
                            @click="editItem(item)"
                            variant="plain"
                            prepend-icon="fa-regular fa-pen-to-square"
                        >
                        Edit Livestock
                        </v-btn>
                    </v-list-item>
                    
                    <v-list-item>
                        <v-btn
                            @click="deleteItem(item)"
                            variant="plain"
                            prepend-icon="fa-regular fa-trash-can"
                        >
                        Archive Livestock
                        </v-btn>
                    </v-list-item>
                </v-list>
            </v-menu>
        </template>
        <template v-slot:no-data>
            <v-btn
            color="primary"
            @click="getFarmerLivestock"
            >
            Reset
            </v-btn>
        </template>
    </v-data-table-server>
</template>
<script>
import axios from 'axios'
import NewLivestockForm from '../forms/NewLivestockForm.vue'
import LivestockVaxForm from '../forms/LivestockVaxForm.vue'
import LivestockMortalityForm from '../forms/AddLivestockMortalityForm.vue'

export default {
    data: () => ({
        livestocks:[],
        selectedLivestocks:[],
        itemsPerPage:10,

        dialog: false,
        dialogDelete: false,
        headers: [
            { title: 'Livestock Type', key: 'livestockType', },
            { title: 'Age', key: 'age' },
            { title: 'Age Classification', key: 'ageClass',class: 'd-none d-sm-table-cell' },
            { title: 'Sex', key: 'sex' },
            { title: 'Actions', key: 'actions', sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            Livestock_ID:'',
            LivestockTagID:'',
            livestockType: '',
            breedName:'',
            age: '',
            ageClass: '',
            sex: '',
            breed:'',
            Date_Of_Birth: ''
        },
        defaultItem: {
            LivestockTagID:'',
            livestockType: '',
            breedName:'',
            age: '',
            ageClass: '',
            sex: '',
            breed:'',
            Date_Of_Birth: ''
        },
    }),

    components:{
        NewLivestockForm,
        LivestockVaxForm,
        LivestockMortalityForm
    },

    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'New Livestock' : 'Edit Livestock'
        },
    },

    watch: {
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
    },

    created () {
        this.getFarmerLivestock()
    },

    methods: {
        async getFarmerLivestock(){
            const livestocks = await axios.get(`farmer/getAllFarmerLivestock/${1}`);
            this.livestocks = livestocks.data;
            console.log(livestocks.data);
        },

        onSelectionUpdate(selected) {
            this.selectedLivestocks = selected;
        } ,

        editItem (item) {
            this.editedIndex = this.livestocks.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
            this.editedIndex = this.livestocks.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            this.livestocks.splice(this.editedIndex, 1)
            this.closeDelete()
        },

        close () {
            this.dialog = false
            this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
            })
        },

        closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
            })
        },

        save () {
            if (this.editedIndex > -1) {
                const formData = new FormData()
                formData.append('Livestock_ID',this.editedItem.Livestock_ID)
                formData.append('LivestockTagID',this.editedItem.LivestockTagID)
                formData.append('Livestock_Type',this.editedItem.livestockType)
                formData.append('ageClass',this.editedItem.ageClass)
                formData.append('sex',this.editedItem.sex)

            } else {
                console.log(this.editedItem);
            }
            this.close()
        },
    },
}
</script>