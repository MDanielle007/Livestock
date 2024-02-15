<template>
    <v-row justify="center">
        <v-dialog
            v-model="dialog"
            scrollable
            width="auto"
        >
            <template v-slot:activator="{ props }">
                <v-container>
                    <v-text-field
                    density="compact"
                    color="primary"
                    v-bind="props"
                    :label="labelText"
                    variant="outlined"
                    v-model="selectedInList"
                >
                </v-text-field>
                </v-container>
            </template>
            <v-card>
                <v-card-title>Select Livestock</v-card-title>
                <v-divider></v-divider>
                <v-card-text style="height: 400px; width: 300px;">
                    <v-list
                        v-if="livestocksListItems"
                    >
                        <v-list-item v-for="(livestock, index) in livestocksListItems" :key="index" @click="selectLivestock(livestock.Livestock_TagID,livestock.Livestock_ID)">
                            <v-list-item-content>
                                <v-list-item-title>{{ livestock.Livestock_Type }}</v-list-item-title>
                                <v-list-item-subtitle>{{ livestock.Livestock_TagID }}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
export default {
    data () {
        return {
            selectedInList:'',
            dialog: false,
        }
    },
    props:[
        'labelText',
        'livestocksListItems'
    ],
    methods:{
        selectLivestock(livestockTagID,livestockID) {
            // Update selectedLivestock when a v-list-item is clicked
            this.selectedInList = livestockTagID;
            this.$emit('livestock-selected', livestockTagID);
            this.$emit('livestock-selectedID', livestockID);
            this.dialog = false
        },
        clearTextField() {
            this.selectedInList = '';
        },
    }
}
</script>