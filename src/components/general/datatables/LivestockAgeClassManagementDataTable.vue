<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Dialog
            v-model:visible="newLivestockAgeClassDialog"
            modal
            header="New Livestock Age Classification"
            :style="{ width: '30rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockType"
                        v-model="livestockAgeClass.livestockTypeId"
                        :options="livestockTypes"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Type"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Age Classification"
                        class="w-full"
                        id="livestockAgeClassification"
                        autocomplete="off"
                        v-model="livestockAgeClass.livestockAgeClassification"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Age Range"
                        class="w-full"
                        id="ageClassRange"
                        autocomplete="off"
                        v-model="livestockAgeClass.ageClassRange"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="newLivestockAgeClassDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Age Classification"
                    @click="addNewLivestockAgeClass(livestockAgeClass)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockAgeClassDialog"
            modal
            header="Livestock Age Classification Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-center pr-4">
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="getImagePath(viewlivestockAgeClass.livestockTypeId)"
                        :alt="getLivestockType(viewlivestockAgeClass.livestockTypeId)"
                    />
                </div>
            </div>
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockType"
                        v-model="viewlivestockAgeClass.livestockTypeId"
                        :options="livestockTypes"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Type"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Age Classification"
                        class="w-full"
                        id="livestockAgeClassification"
                        autocomplete="off"
                        v-model="viewlivestockAgeClass.livestockAgeClassification"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Age Range"
                        class="w-full"
                        id="ageClassRange"
                        autocomplete="off"
                        v-model="viewlivestockAgeClass.ageClassRange"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="viewLivestockAgeClassDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="saveEditLivestockAgeClass(viewlivestockAgeClass)"
                ></Button>
            </div>
        </Dialog>
        <DataTable
            v-model:filters="filters"
            :value="livestockAgeClasses"
            :loading="loading"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :globalFilterFields="['livestockAgeClassification', 'ageClassRange','livestockType']"
            class="w-full"
        >
            <template #header>
                <div class="flex justify-content-between align-items-center">
                    <InputText
                        v-model="filters['global'].value"
                        placeholder="Keyword Search"
                    />
                    <Button
                        label="New Livestock Age Classification"
                        class="p-button-success mr-2"
                        @click="newLivestockAgeClassDialog = true"
                    />
                </div>
            </template>
            <template #empty> No livestock age classification found. </template>
            <template #loading>
                Loading livestock age classification data. Please wait...
            </template>
            <Column
                field="livestockType"
                header="Livestock Type"
                style="min-width: 8rem"
            >
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
                        placeholder="Search by Livestock Type"
                    />
                </template>
            </Column>
            <Column
                field="livestockAgeClassification"
                header="Age Classification"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    {{ data.livestockAgeClassification }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Age Classification"
                    />
                </template>
            </Column>
            <Column
                field="ageClassRange"
                header="Age Range"
                style="min-width: 8rem"
            >
                <template #body="{ data }">
                    {{ data.ageClassRange }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Age Range"
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
                        @click="editLivestockAgeClass(slotProps.data)"
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
import { FilterMatchMode } from "primevue/api";

export default {
    data() {
        return {
            loading: true,
            filters: null,
            viewLivestockAgeClassDialog: false,
            newLivestockAgeClassDialog: false,
            livestockAgeClass: {
                livestockAgeClassification: "",
                ageClassRange: "",
                livestockTypeId: "",
            },
            viewlivestockAgeClass: {
                id: "",
                livestockAgeClassification: "",
                ageClassRange: "",
                livestockTypeId: "",
            },
            livestockAgeClasses: null,
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
        };
    },
    created() {
        this.initFilters();
    },
    mounted(){
        LivestockService.getLivestockAgeClasses().then((data) => {
            this.livestockAgeClasses = this.getLivestockAgeClasses(data)
            console.log(this.livestockAgeClasses);
            this.loading = false;
        });
    },
    methods: {
        clearFilter() {
            this.initFilters();
        },
        initFilters() {
            this.filters = {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                livestockAgeClassification: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                ageClassRange: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockType:{
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                }
            };
        },
        getLivestockAgeClasses(data){
            return [...(data || [])].map((d) => {
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
        editLivestockAgeClass(data) {
            this.viewlivestockAgeClass = data;
            this.viewLivestockAgeClassDialog = true;
        },
        async addNewLivestockAgeClass(livestockAgeClass) {
            console.log(livestockAgeClass);
        },
        async saveEditLivestockAgeClass(livestockAgeClass) {
            console.log(livestockAgeClass);
        },
    },
};
</script>
