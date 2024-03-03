<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Toolbar class="mb-2 w-full">
            <template #start>
                <div>
                    <div class="text-3xl font-bold text-700">
                        Livestock Vaccinations
                    </div>
                </div>
            </template>
        </Toolbar>
        <Dialog
            v-model:visible="newLivestockVaccinationDialog"
            modal
            header="New Livestock Vaccination"
            :style="{ width: '30rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        v-model="livestockVaccination.vaccineAdministratorId"
                        :options="farmers"
                        filter
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select a Vaccine Administrator"
                        class="w-full"
                    >
                    </Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="vaccinationDate"
                        v-model="livestockVaccination.vaccinationDate"
                        class="w-full"
                        placeholder="Select Vaccination Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockId"
                        v-model="livestockVaccination.livestockId"
                        :options="livestockToVaccinate"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="livestockVaccination.vaccinationName"
                        placeholder="Vaccine name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="livestockVaccination.vaccinationDescription"
                        placeholder="Vaccination description"
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
                    @click="newLivestockVaccinationDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock"
                    @click="addNewLivestockVaccination(livestockVaccination)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockVaccinationDialog"
            modal
            header="Livestock Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-between pr-4">
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="getImagePath(viewLivestockVaccination.livestockTypeId)"
                        :alt="getLivestockType(viewLivestockVaccination.livestockTypeId)"
                    />
                </div>
            </div>
            <div class="mt-3 formgrid grid-nogutter h-24 rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        v-model="viewLivestockVaccination.vaccineAdministratorId"
                        :options="farmers"
                        filter
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select a Vaccine Administrator"
                        class="w-full"
                    >
                    </Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="vaccinationDate"
                        v-model="viewLivestockVaccination.vaccinationDate"
                        class="w-full"
                        placeholder="Select Vaccination Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockId"
                        v-model="viewLivestockVaccination.livestockId"
                        :options="livestockToVaccinate"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="viewLivestockVaccination.vaccinationName"
                        placeholder="Vaccine name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="viewLivestockVaccination.vaccinationDescription"
                        placeholder="Vaccination description"
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
                    @click="viewLivestockVaccinationDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="saveEditLivestock(viewLivestock)"
                ></Button>
            </div>
        </Dialog>
        <DataTable
            v-model:filters="filters"
            :value="livestockVaccinations"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :loading="loading"
            :globalFilterFields="[
                'administratorName',
                'livestockTagId',
                'livestockType',
                'vaccinationName',
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
                        label="New Livestock Vaccination"
                        class="p-button-success mr-2"
                        @click="newLivestockVaccinationDialog = true"
                    />
                </div>
            </template>
            <template #empty> No livestock vaccination found. </template>
            <template #loading>
                Loading livestock vaccination data. Please wait...
            </template>
            <Column
                field="administratorName"
                header="Administrator"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    {{ data.administratorName }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Administrator"
                    />
                </template>
            </Column>
            <Column
                field="vaccinationName"
                header="Vaccination"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    {{ data.vaccinationName }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Vaccination"
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
                        />
                        <div>
                            {{ data.livestockType }}
                        </div>
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
                filterField="vaccinationDate"
                dataType="date"
                style="min-width: 10rem"
            >
                <template #body="{ data }">
                    {{ formatDate(data.vaccinationDate) }}
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
                        @click="editLivestockVaccination(slotProps.data)"
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
import { VaccinationService } from "@/services/VaccinationService";
import { FilterMatchMode, FilterOperator } from "primevue/api";

export default {
    data() {
        return {
            livestocks: null,
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

            livestockVaccinations: null,
            viewLivestockVaccinationDialog: false,
            newLivestockVaccinationDialog: false,
            livestockVaccination: {
                vaccineAdministratorId: "",
                livestockId: "",
                vaccinationName: "",
                vaccinationDescription: "",
                vaccinationDate: "",
            },
            viewLivestockVaccination: {
                id: "",
                vaccineAdministratorId: "",
                livestockId: "",
                vaccinationName: "",
                vaccinationDescription: "",
                vaccinationDate: "",
                recordStatus: "",
                livestockTagId: "",
                livestockTypeId: "",
                livestockAgeClassId: "",
                administratorName: "",
            },
            livestockToVaccinate: [],

            filters: null,
            loading: true,
        };
    },
    created() {
        this.initFilters();
    },
    mounted() {
        VaccinationService.getVaccinationData().then((data) => {
            this.livestockVaccinations = this.getLivestockVaccinations(data);
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
        getLivestockVaccinations(data) {
            return [...(data || [])].map((d) => {
                d.vaccinationDate = new Date(d.vaccinationDate);
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
        editLivestockVaccination(data) {
            this.viewLivestockVaccination = data;
            console.log(this.viewLivestockVaccination);
            this.viewLivestockVaccinationDialog = true;
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
        addNewLivestockVaccination(livestockVaccination){
            console.log(livestockVaccination);
        }
    },
};
</script>
