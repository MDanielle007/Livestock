<template>
    <v-data-table
        :headers="headers"
        :items="vaccinationRecords"
        :sort-by="[{ key: 'vaccinationDate', order: 'desc' }]"
    >
        <template v-slot:top>
            <v-toolbar
            >
            <v-toolbar-title>Vaccination Records</v-toolbar-title>
            <v-dialog
                v-model="dialog"
                max-width="500px"
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
                        sm="6"
                        >
                        <v-text-field
                            v-model="editedItem.LivestockTagID"
                            label="Livestock ID"
                            readonly
                        ></v-text-field>
                        </v-col>

                        <v-col
                        cols="12"
                        sm="6"
                        >
                        <v-text-field
                            v-model="editedItem.LivestockType"
                            label="Livestock Type"
                            readonly
                        ></v-text-field>
                        </v-col>

                        <v-col
                        cols="12"
                        >
                        <v-text-field
                            v-model="editedItem.vaccinationName"
                            label="Vaccination Name"
                        ></v-text-field>
                        </v-col>
                        <v-col
                        cols="12"
                        >
                        <v-textarea
                            v-model="editedItem.vaccinationDetails"
                            label="Vaccination Details"
                        ></v-textarea>
                        </v-col>
                        <v-col
                        cols="12"
                        sm="6"
                        >
                        <v-text-field
                            v-model="editedItem.vaccinationDate"
                            label="Vaccination Date"
                            type="date"
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
            @click="initialize"
            >
            Reset
            </v-btn>
        </template>
    </v-data-table>
</template>
<script>
import axios from 'axios'
import { getCookie } from '@/utils/cookieUtils.js'
import { jwtDecode as jwt_decode } from 'jwt-decode';

export default {
    data: () => ({
        userid:'',
        dialog: false,
        dialogDelete: false,
        headers: [
            {
                title: 'Livestock',
                align: 'start',
                sortable: false,
                key: 'LivestockTagID',
            },
            { title: 'Vaccination Name', key: 'vaccinationName' },
            { title: 'Date', key: 'vaccinationDate' },
            { title: 'Actions', key: 'actions', sortable: false },
        ],
        vaccinationRecords:[],
        editedIndex: -1,
        editedItem: {
            livestockID:'',
            Vaccination_ID:'',
            LivestockTagID:'',
            LivestockType:'',
            vaccinationName: '',
            vaccinationDetails: '',
            vaccinationDate: null,
        },
        defaultItem: {
            livestockID:'',
            Vaccination_ID:'',
            LivestockTagID:'',
            LivestockType:'',
            vaccinationName: '',
            vaccinationDetails: '',
            vaccinationDate: null,
        },
    }),

    computed: {
        formTitle () {
        return this.editedIndex === -1 ? 'New Vaccination Record' : 'Edit Vaccination Record'
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
        this.getFarmerVaccinationRecord()
    },

    methods: {
        async getFarmerVaccinationRecord () {
            try {
                const token = getCookie('token');

                const decodedToken = jwt_decode(token);

                this.userid = decodedToken.userid

                const response = await axios.get(`farmer/getFarmerVaccinationRecords/${this.userid}`)
                this.vaccinationRecords = response.data
            } catch (error) {
                console.log(error);
            }
        },

        editItem (item) {
            this.editedIndex = this.vaccinationRecords.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
            this.editedIndex = this.vaccinationRecords.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        async deleteItemConfirm () {
            const formData = new FormData()
            formData.append('Vaccination_ID',this.editedItem.Vaccination_ID)
            formData.append('Farmer_ID',this.userid)
            formData.append('LivestockTagID',this.editedItem.LivestockTagID)
            formData.append('livestockID',this.editedItem.livestockID)
            const response = await axios.post('farmer/archiveVaccinationRecord',formData)
            console.log(response);
            this.getFarmerVaccinationRecord();
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

        async save () {
            if (this.editedIndex > -1) {
                const formData = new FormData()
                formData.append('Vaccination_ID',this.editedItem.Vaccination_ID)
                formData.append('vaccinationName',this.editedItem.vaccinationName)
                formData.append('vaccinationDetails',this.editedItem.vaccinationDetails)
                formData.append('vaccinationDate',this.editedItem.vaccinationDate)
                formData.append('LivestockTagID',this.editedItem.LivestockTagID)
                formData.append('livestockID',this.editedItem.livestockID)
                formData.append('Farmer_ID',this.userid)
                const response = await axios.post('farmer/updateVaccinationRecord',formData)
                console.log(response.data);
            } else {
                this.vaccinationRecords.push(this.editedItem)
            }

            this.getFarmerVaccinationRecord();

            this.close()
        },
    },
}
</script>