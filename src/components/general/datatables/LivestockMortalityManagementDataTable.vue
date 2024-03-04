<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Toolbar class="mb-2 w-full">
            <template #start>
                <div>
                    <div class="text-3xl font-bold text-700">
                        Livestock Mortality
                    </div>
                </div>
            </template>
        </Toolbar>
        <Dialog
            v-model:visible="newLivestockMortalityDialog"
            modal
            header="New Livestock Vaccination"
            :style="{ width: '30rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        v-model="livestockMortality.farmerId"
                        :options="farmers"
                        filter
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select a Farmer"
                        class="w-full"
                    >
                    </Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="dateOfDeath"
                        v-model="livestockMortality.dateOfDeath"
                        class="w-full"
                        placeholder="Select Date of Death"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockId"
                        v-model="livestockMortality.livestockId"
                        :options="livestockOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="livestockMortality.causeOfDeath"
                        placeholder="Cause of death"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="livestockMortality.additionalDeathNotes"
                        placeholder="Additional notes"
                        rows="5"
                        class="w-full"
                        cols="30"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="newLivestockMortalityDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock"
                    @click="addNewLivestockMortality(livestockMortality)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockMortalityDialog"
            modal
            header="Livestock Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-between pr-4">
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="
                            getImagePath(
                                viewLivestockMortality.livestockTypeId
                            )
                        "
                        :alt="
                            getLivestockType(
                                viewLivestockMortality.livestockTypeId
                            )
                        "
                    />
                </div>
            </div>
            <div class="mt-3 formgrid grid-nogutter h-24 rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        v-model="
                            viewLivestockMortality.farmerId
                        "
                        :options="farmers"
                        filter
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select a Farmer"
                        class="w-full"
                    >
                    </Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="dateOfDeath"
                        v-model="viewLivestockMortality.dateOfDeath"
                        class="w-full"
                        placeholder="Select Date of Death"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockId"
                        v-model="viewLivestockMortality.livestockId"
                        :options="livestockOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="viewLivestockMortality.causeOfDeath"
                        placeholder="Cause of Death"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="
                            viewLivestockMortality.additionalDeathNotes
                        "
                        placeholder="Additional Death Notes"
                        rows="5"
                        class="w-full"
                        cols="30"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="viewLivestockMortalityDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="saveEditLivestock(viewLivestockMortality)"
                ></Button>
            </div>
        </Dialog>
        <DataTable
            v-model:filters="filters"
            :value="livestockMortalities"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :loading="loading"
            :globalFilterFields="[
                'farmerName',
                'livestockTagId',
                'livestockType',
                'causeOfDeath',
            ]"
            class="w-full"
        >
            <template #header>
                <div class="flex justify-content-between align-items-center">
                    <InputText
                        v-model="filters['global'].value"
                        placeholder="Keyword Search"
                    />
                    <Button
                        label="New Livestock Mortality"
                        class="p-button-success mr-2"
                        @click="newLivestockMortalityDialog = true"
                    />
                </div>
            </template>
            <template #empty> No livestock vaccination found. </template>
            <template #loading>
                Loading livestock vaccination data. Please wait...
            </template>
            <Column field="farmerName" header="Farmer" style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.farmerName }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Farmer"
                    />
                </template>
            </Column>
            <Column
                field="causeOfDeath"
                header="Cause"
                style="min-width: 9rem"
            >
                <template #body="{ data }">
                    {{ data.causeOfDeath }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Cause of Death"
                    />
                </template>
            </Column>
            <Column
                field="livestockTagId"
                header="Livestock"
                style="min-width: 9rem"
            >
                <template #body="{ data }">
                    {{ data.livestockTagId }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Livestock Tag Id"
                    />
                </template>
            </Column>
            <Column field="livestockType" header="Type" style="min-width: 6rem">
                <template #body="{ data }">
                    <div class="flex gap-2 align-items-center">
                        <Avatar
                            :image="getImagePath(data.livestockTypeId)"
                            class="mr-2"
                            shape="circle"
                            v-tooltip.top="data.livestockType"
                        />
                    </div>
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Type"
                    />
                </template>
            </Column>
            <Column
                header="Date"
                filterField="dateOfDeath"
                dataType="date"
                style="min-width: 10rem"
            >
                <template #body="{ data }">
                    {{ formatDate(data.dateOfDeath) }}
                </template>
                <template #filter="{ filterModel }">
                    <Calendar
                        v-model="filterModel.value"
                        dateFormat="mm/dd/yy"
                        placeholder="mm/dd/yyyy"
                        mask="99/99/9999"
                    />
                </template>
            </Column>
            <Column :exportable="false" style="min-width: 8rem">
                <template #body="slotProps">
                    <Button
                        icon="pi pi-pencil"
                        outlined
                        rounded
                        class="mr-2"
                        @click="editLivestockMortality(slotProps.data)"
                    />
                    <Button
                        icon="pi pi-trash"
                        outlined
                        rounded
                        severity="danger"
                        @click="confirmDeleteProduct(slotProps.data)"
                    />
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import { LivestockService } from "@/services/LivestockServices";
import { MortalityService } from "@/services/MortalityService";
import { FilterMatchMode, FilterOperator } from "primevue/api";

export default {
    data() {
        return {
            livestockTypes: [
                {
                    name: "Chicken",
                    code: "1",
                },
                {
                    name: "Pig",
                    code: "2",
                },
                {
                    name: "Cattle",
                    code: "3",
                },
                {
                    name: "Carabao",
                    code: "4",
                },
            ],

            farmers: [
                {
                    name: "Aba Cus",
                    code: "1",
                },
                {
                    name: "Ba Doy",
                    code: "2",
                },
                {
                    name: "Cak E",
                    code: "3",
                },
                {
                    name: "Marc Danielle Cabatay",
                    code: "4",
                },
            ],

            livestockMortalities: null,
            newLivestockMortalityDialog: false,
            viewLivestockMortalityDialog: false,
            livestockMortality: {
                livestockId: "",
                farmerId: "",
                causeOfDeath: "",
                additionalDeathNotes: "",
                dateOfDeath: null,
            },
            viewLivestockMortality: {
                id: "",
                livestockId: "",
                livestockTagId: "",
                livestockTypeId: "",
                farmerId: "",
                farmerUserId: "",
                farmerName: "",
                causeOfDeath: "",
                additionalDeathNotes: "",
                dateOfDeath: "",
            },
            livestockOptions: [],

            filters: null,
            loading: true,
        };
    },
    created() {
        this.initFilters();
    },
    mounted() {
        LivestockService.getAllLivestockOptions().then((data)=>{
            this.livestocks = data;
            this.loading = false;
        });

        MortalityService.getLivestockMortality().then((data) => {
            this.livestockMortalities = this.getLivestockMortalities(data);
            this.loading = false;
        });
    },
    methods: {
        formatDate(value) {
            return value.toLocaleDateString("en-US", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
            });
        },

        clearFilter() {
            this.initFilters();
        },
        initFilters() {
            this.filters = {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                administratorName: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                vaccinationName: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockTagId: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockType: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                vaccinationDate: {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.DATE_IS },
                    ],
                },
            };
        },
        getLivestockMortalities(data) {
            return [...(data || [])].map((d) => {
                d.dateOfDeath = new Date(d.dateOfDeath);
                d.livestockType = this.getLivestockType(d.livestockTypeId);

                return d;
            });
        },
        getLivestockType(type) {
            const livestockType = this.livestockTypes.find(
                (option) => option.code === type
            );
            return livestockType.name;
        },
        getImagePath(type) {
            switch (type) {
                case "1":
                    return "/icons/livestock-icons/chicken-96.png";
                case "2":
                    return "/icons/livestock-icons/pig-96.png";
                case "3":
                    return "/icons/livestock-icons/cattle-96.png";
                case "4":
                    return "/icons/livestock-icons/water-buffalo-96.png";
                case "5":
                    return "/icons/livestock-icons/goat-96.png";
                case "6":
                    return "/icons/livestock-icons/sheep-96.png";
                default:
                    return ""; // You can provide a default image path if needed
            }
        },
        editLivestockMortality(data) {
            this.viewLivestockMortality = data;
            console.log(this.viewLivestockMortality);
            this.viewLivestockMortalityDialog = true;
        },
        generatelivestockVaccinateOptions() {
            if (this.livestocks) {
                this.livestockToVaccinate = this.livestocks.map(
                    (livestock) => ({
                        name: livestock.livestockTagId,
                        code: livestock.id,
                    })
                );
            }
        },
        generatelivestockOptions(farmerId) {
            if (this.livestocks) {
                const filteredLivestocks = this.livestocks.filter(
                    (livestock) => livestock.farmerId === farmerId
                );
                // Map the filtered livestock to options
                this.livestockOptions = filteredLivestocks.map((livestock) => ({
                    name: livestock.livestockTagId,
                    code: livestock.id,
                }));
            }
        },
        addNewLivestockMortality(livestockMortality) {
            console.log(livestockMortality);
        },
        saveEditLivestock(livestockMortality){
            console.log(livestockMortality);
        }
    },
    watch: {
        "livestockMortality.farmerId"(newVal, oldVal) {
            this.generatelivestockOptions(newVal)
        },
        "viewLivestockMortality.farmerId"(newVal, oldVal) {
            this.generatelivestockOptions(newVal)
        }
    },
};
</script>
