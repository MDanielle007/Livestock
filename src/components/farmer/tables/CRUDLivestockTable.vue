<template>
    <v-data-table-server
        :headers="headers"
        :items="livestocks"
        :sort-by="[{ key: 'livestockType', order: 'asc' }]"
        show-select
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
                    max-width="500px"
                >
                    <template v-slot:activator="{ props }">
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="props"
                        >
                            New Item
                        </v-btn>
                    </template>
                    <v-card>
                    <v-card-title>
                        <span class="text-h5">{{ formTitle }}</span>
                    </v-card-title>
        
                    <v-card-text>
                        <v-container>
                        <v-row>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                                >
                                <v-text-field
                                    variant="outlined"
                                    v-model="editedItem.livestockType"
                                    label="Livestock Type"
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
                                    v-model="editedItem.sex"
                                    label="Sex"
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
            <v-icon
            size="small"
            class="me-2"
            @click="editItem(item)"
            >
            fa-regular fa-pen-to-square
            </v-icon>
            <v-icon
            size="small"
            @click="deleteItem(item)"
            >
            fa-regular fa-trash-can
            </v-icon>
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

export default {
    data: () => ({
        livestocks:[],

        dialog: false,
        dialogDelete: false,
        headers: [
            { title: 'Livestock Type', key: 'livestockType' },
            { title: 'Age', key: 'age' },
            { title: 'Age Classification', key: 'ageClass' },
            { title: 'Sex', key: 'sex' },
            { title: 'Actions', key: 'actions', sortable: false },
        ],
        desserts: [],
        editedIndex: -1,
        editedItem: {
            livestockType: '',
            age: '',
            ageClass: '',
            sex: '',
        },
        defaultItem: {
            livestockType: '',
            age: '',
            ageClass: '',
            sex: '',
        },
    }),
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
            console.log(livestocks);
        },

        editItem (item) {
            this.editedIndex = this.livestocks.indexOf(item)
            console.log(this.editedIndex);
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
                Object.assign(this.livestocks[this.editedIndex], this.editedItem)
            } else {
                this.livestocks.push(this.editedItem)
            }
            this.close()
        },
    },
}
</script>