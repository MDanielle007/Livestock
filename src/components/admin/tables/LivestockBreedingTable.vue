<template>
    <v-data-table
      :headers="headers"
      :items="breedingRecords"
      :sort-by="[{ key: 'breedDate', order: 'asc' }]"
    >
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>Breeding Records</v-toolbar-title>
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
                      sm="5"
                    >
                      <v-text-field
                        v-model="editedItem.BreedResults"
                        label="Breeding Results"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="3"
                    >
                      <v-text-field
                        type="date"
                        v-model="editedItem.BreedDate"
                        label="Breed Date"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="4"
                    >
                      <v-text-field
                        v-model="editedItem.FarmerName"
                        label="Farmer Name"
                        readonly
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="6"
                    >
                      <v-text-field
                        v-model="editedItem.MaleLivestock"
                        label="Male Livestock"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="6"
                    >
                      <v-text-field
                        v-model="editedItem.FemaleLivestock"
                        label="Female Livestock"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                    >
                      <v-textarea
                        v-model="editedItem.BreedNotes"
                        label="Breed Notes"
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
export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
            { title: 'Male Livestock', key: 'MaleLivestock' },
            { title: 'Female Livestock', key: 'FemaleLivestock' },
            { title: 'Breeding Result', key: 'BreedResults' },
            { title: 'Date', key: 'BreedDate' },
            { title: 'Actions', key: 'actions', sortable: false },
        ],
        desserts: [],
        breedingRecords:[],
        editedIndex: -1,
        editedItem: {
            LB_ID:'',
            FarmerID:'',
            MaleLivestock:'',
            FemaleLivestock:'',
            BreedResults:'',
            BreedNotes:'',
            BreedDate:'',
            FarmerName:'',
        },
        defaultItem: {
            LB_ID:'',
            FarmerID:'',
            MaleLivestock:'',
            FemaleLivestock:'',
            BreedResults:'',
            BreedNotes:'',
            BreedDate:'',
            FarmerName:'',
        },
    }),

    computed: {
        formTitle () {
            return 'Breeding Record Details'
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
        this.initialize()
    },

    methods: {
        async initialize () {
            try {
                const response = await axios.get('admin/getLivestockBreedingRecords')
                this.breedingRecords = response.data
            } catch (error) {
                this.breedingRecords = []
                console.log(error)
            }
        },

        editItem (item) {
            this.editedIndex = this.breedingRecords.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
            this.editedIndex = this.breedingRecords.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        async deleteItemConfirm () {
            try {
                const formData = new FormData();
                formData.append('LB_ID',this.editedItem.LB_ID)

                const response = await axios.post('admin/archiveLivestockBreedingRecord',formData)
                console.log(response.data);
            } catch (error) {
                console.log(error);
            }

            this.initialize()

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
                const formData = new FormData();
                formData.append('LB_ID',this.editedItem.LB_ID)
                formData.append('MaleLivestock',this.editedItem.MaleLivestock)
                formData.append('FemaleLivestock',this.editedItem.FemaleLivestock)
                formData.append('BreedResults',this.editedItem.BreedResults)
                formData.append('BreedNotes',this.editedItem.BreedNotes)
                formData.append('BreedDate',this.editedItem.BreedDate)
                
                const response = await axios.post('admin/editLivestockBreedingRecord',formData);
                console.log(response);
            }

            this.initialize()
            this.close()
        },
    },
}
</script>