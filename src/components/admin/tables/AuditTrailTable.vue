<template>
    <v-data-table
      :headers="headers"
      :items="dataHistory"
      :sort-by="[{ key: 'Timestamp', order: 'desc' }]"
    >
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>Audit Trail</v-toolbar-title>
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
                        >
                        <v-text-field
                            variant="outlined"
                            v-model="editedItem.Livestock_TagID"
                            label="Livestock Tag ID"
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
export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      { title: 'Farmer Name', key: 'FarmerName' },
      { title: 'Entity Affected', key: 'Type' },
      { title: 'Title', key: 'Title' },
      { title: 'Livestock', key: 'Livestock_TagID' },
      { title: 'Timestamp', key: 'Timestamp' },
      { title: 'Actions', key: 'actions', sortable: false },
    ],
    dataHistory: [],
    editedIndex: -1,
    editedItem: {
      FDH_ID:'',
      Title:'',
      Description:'',
      Type:'',
      Livestock_ID:'',
      Action:'',
      Farmer_ID:'',
      Timestamp:'',
      Livestock_TagID:'',
      Livestock_Type:'',
      FarmerName:'',
    },
    defaultItem: {
      FDH_ID:'',
      Title:'',
      Description:'',
      Type:'',
      Livestock_ID:'',
      Action:'',
      Farmer_ID:'',
      Timestamp:'',
      Livestock_TagID:'',
      Livestock_Type:'',
      FarmerName:'',
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
    this.initialize()
  },

  methods: {
    async initialize () {
      try{
        const response = await axios.get('admin/getDataHistory');
        this.dataHistory = response.data
      }catch(error){
        console.log(error);
      }
    },

    editItem (item) {
      this.editedIndex = this.dataHistory.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      this.editedIndex = this.dataHistory.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm () {
      this.dataHistory.splice(this.editedIndex, 1)
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
        Object.assign(this.dataHistory[this.editedIndex], this.editedItem)
      } else {
        this.dataHistory.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>