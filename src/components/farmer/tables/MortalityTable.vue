<template>
    <v-data-table
      :headers="headers"
      :items="mortalityRecords"
      :sort-by="[{ key: 'dateOfDeath', order: 'desc' }]"
    >
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>Mortality Records</v-toolbar-title>
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
                        v-model="editedItem.LivestockID"
                        label="Livestock ID"
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
                      sm="6"
                    >
                      <v-text-field
                        v-model="editedItem.LivestockTagID"
                        label="Livestock Tag ID"
                        readonly
                      ></v-text-field>
                    </v-col>

                    <v-col
                      cols="12"
                      sm="6"
                    >
                      <v-text-field
                        type="date"
                        v-model="editedItem.dateOfDeath"
                        label="Date of Death"
                      ></v-text-field>
                    </v-col>

                    <v-col
                      cols="12"
                    >
                      <v-textarea
                        v-model="editedItem.causeOfDeath"
                        label="Cause of Death"
                      ></v-textarea>
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
        { title: 'Cause of Death', key: 'causeOfDeath' },
        { title: 'Date of Death', key: 'dateOfDeath' },
        { title: 'Actions', key: 'actions', sortable: false },
    ],
    mortalityRecords:[],
    editedIndex: -1,
    editedItem: {
        LM_ID:'',
        LivestockID:'',
        LivestockType:'',
        LivestockTagID: '',
        causeOfDeath: '',
        dateOfDeath: null,
    },
    defaultItem: {
        LM_ID:'',
        LivestockID:'',
        LivestockType:'',
        LivestockTagID: '',
        causeOfDeath: '',
        dateOfDeath: null,
    },
    }),

    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
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
        this.getFarmerMortalityRecords();
    },

    methods: {
    async getFarmerMortalityRecords(){
        try {
          const token = getCookie('token');

          const decodedToken = jwt_decode(token);

          this.userid = decodedToken.userid

          const reponse = await axios.get(`farmer/getFarmerMortalityRecords/${this.userid}`);
          this.mortalityRecords = reponse.data;
        } catch (error) {
          console.log(error);
        }
    },

    editItem (item) {
        this.editedIndex = this.mortalityRecords.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
    },

    deleteItem (item) {
        this.editedIndex = this.mortalityRecords.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
    },

    async deleteItemConfirm () {
        const formData = new FormData();
        formData.append('LM_ID',this.editedItem.LM_ID)
        formData.append('Farmer_ID',this.userid)
        formData.append('LivestockTagID',this.editedItem.LivestockTagID)
        formData.append('LivestockID',this.editedItem.LivestockID)
        const response = await axios.post('farmer/archiveMortalityRecord',formData)
        console.log(response);
        this.getFarmerMortalityRecords()
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
          formData.append('LM_ID',this.editedItem.LM_ID)
          formData.append('causeOfDeath',this.editedItem.causeOfDeath)
          formData.append('dateOfDeath',this.editedItem.dateOfDeath)
          formData.append('Farmer_ID',this.userid)
          formData.append('LivestockTagID',this.editedItem.LivestockTagID)
          formData.append('LivestockID',this.editedItem.LivestockID)
          const response = await axios.post('farmer/updateMortalityRecord',formData)
          console.log(response);
        } else {
        this.mortalityRecords.push(this.editedItem)
        }

        this.getFarmerMortalityRecords();
        this.close()
    },
    },
}
</script>