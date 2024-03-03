<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Dialog
            v-model:visible="newLivestockBreedingDialog"
            modal
            header="New Livestock Breeding"
            :style="{ width: '30rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="breedingDate"
                        v-model="livestockBreeding.breedDate"
                        class="w-full"
                        placeholder="Select Breeding Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="farmerId"
                        v-model="livestockBreeding.farmerId"
                        :options="farmers"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Farmer"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockType"
                        v-model="livestockBreeding.livestockTypeId"
                        :options="livestockTypesOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Type"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="maleLivestockTagId"
                        v-model="livestockBreeding.maleLivestockTagId"
                        :options="maleLivestocksOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="flex-1"
                        placeholder="Male"
                    ></Dropdown>
                    <Dropdown
                        inputId="femaleLivestockTagId"
                        v-model="livestockBreeding.femaleLivestockTagId"
                        :options="femaleLivestockOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="flex-1"
                        placeholder="Female"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="breedResult"
                        v-model="livestockBreeding.breedResult"
                        :options="breedingResultsOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Breeding Result"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="livestockBreeding.breedAdditionalNotes"
                        placeholder="Breeding Additional Notes"
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
                    @click="newLivestockBreedingDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock"
                    @click="addNewLivestockBreeding(livestockBreeding)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockBreedingDialog"
            modal
            header="Livestock Breeding Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-between pr-4">
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="
                            getImagePath(
                                viewLivestockBreeding.livestockTypeId
                            )
                        "
                        :alt="
                            getLivestockType(
                                viewLivestockBreeding.livestockTypeId
                            )
                        "
                    />
                </div>
            </div>
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="breedingDate"
                        v-model="viewLivestockBreeding.breedDate"
                        class="w-full"
                        placeholder="Select Breeding Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="farmerId"
                        v-model="viewLivestockBreeding.farmerId"
                        :options="farmers"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Farmer"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockType"
                        v-model="viewLivestockBreeding.livestockTypeId"
                        :options="livestockTypesOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Type"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="maleLivestockTagId"
                        v-model="viewLivestockBreeding.maleLivestockTagId"
                        :options="filterLivestocksForBreeding(viewLivestockBreeding.farmerId, viewLivestockBreeding.livestockTypeId, 'Male')"
                        optionValue="code"
                        optionLabel="name"
                        class="flex-1"
                        placeholder="Male"
                    ></Dropdown>
                    <Dropdown
                        inputId="femaleLivestockTagId"
                        v-model="viewLivestockBreeding.femaleLivestockTagId"
                        :options="filterLivestocksForBreeding(viewLivestockBreeding.farmerId, viewLivestockBreeding.livestockTypeId, 'Female')"
                        optionValue="code"
                        optionLabel="name"
                        class="flex-1"
                        placeholder="Female"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="breedResult"
                        v-model="viewLivestockBreeding.breedResult"
                        :options="breedingResultsOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Breeding Result"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="viewLivestockBreeding.breedAdditionalNotes"
                        placeholder="Breeding Additional Notes"
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
                    @click="viewLivestockBreedingDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="saveEditLivestockBreeding(viewLivestockBreeding)"
                ></Button>
            </div>
        </Dialog>
        <DataTable
            v-model:filters="filters"
            :value="livestockBreedings"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :loading="loading"
            :globalFilterFields="[
                'farmerUserId',
                'maleLivestockTagId',
                'femaleLivestockTagId',
                'livestockType',
                'breedResult',
                'date',
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
                        label="New Livestock Breeding"
                        class="p-button-success mr-2"
                        @click="newLivestockBreedingDialog = true"
                    />
                </div>
            </template>
            <template #empty> No livestock breedings found. </template>
            <template #loading>
                Loading livestock breeding data. Please wait...
            </template>
            <Column
                field="farmerUserId"
                header="Farmer"
                style="min-width: 8rem"
            >
                <template #body="{ data }">
                    {{ data.farmerUserId }}
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
                field="maleLivestockTagId"
                header="Male Livestock"
                style="min-width: 6rem"
            >
                <template #body="{ data }">
                    {{ data.maleLivestockTagId }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Male Livestock"
                    />
                </template>
            </Column>
            <Column
                field="femaleLivestockTagId"
                header="Female Livestock"
                style="min-width: 6rem"
            >
                <template #body="{ data }">
                    {{ data.femaleLivestockTagId }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Female Livestock"
                    />
                </template>
            </Column>

            <Column field="breedResult" header="Result" style="min-width: 9rem">
                <template #body="{ data }">
                    {{ data.breedResult }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Breed Result"
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
                filterField="date"
                dataType="date"
                style="min-width: 10rem"
            >
                <template #body="{ data }">
                    {{ formatDate(data.date) }}
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
                        @click="editLivestockBreeding(slotProps.data)"
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
import { BreedingService } from "@/services/BreedingServices";
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

            livestockBreedings: null,
            viewLivestockBreedingDialog: false,
            newLivestockBreedingDialog: false,
            livestockBreeding: {
                farmerId: "",
                livestockTypeId: "",
                maleLivestockTagId: "",
                femaleLivestockTagId: "",
                breedResult: "",
                breedAdditionalNotes: "",
                breedDate: "",
            },
            viewLivestockBreeding: {
                id: "",
                farmerId: "",
                farmerName: "",
                farmerUserId: "",
                livestockTypeId: "",
                maleLivestockTagId: "",
                femaleLivestockTagId: "",
                breedResult: "",
                breedAdditionalNotes: "",
                breedDate: "",
            },
            livestockTypesOptions: [
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
            livestocks: null,
            filteredLivestocks: null,
            maleLivestocksOptions: [],
            femaleLivestockOptions: [],
            breedingResultsOptions: [
                {
                    name: "Successful Breeding",
                    code: "Successful Breeding",
                },
                {
                    name: "Unsuccessful Breeding",
                    code: "Unsuccessful Breeding",
                },
            ],
            filters: null,
            loading: true,
        };
    },
    created() {
        this.initFilters();
    },
    mounted() {
        LivestockService.getLivestockForBreeding().then((data) => {
            this.livestocks = data;
            console.log(this.livestocks);
            this.loading = false;
        });

        BreedingService.getLivestockBreedingData().then((data) => {
            this.livestockBreedings = this.getLivestockBreedings(data);
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
                farmerUserId: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                maleLivestockTagId: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                femaleLivestockTagId: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockType: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                date: {
                    operator: FilterOperator.AND,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.DATE_IS },
                    ],
                },
            };
        },
        getLivestockBreedings(data) {
            return [...(data || [])].map((d) => {
                d.date = new Date(d.breedDate);
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
        editLivestockBreeding(data) {
            this.viewLivestockBreeding = data;
            console.log(this.viewLivestockBreeding);
            this.viewLivestockBreedingDialog = true;
        },
        saveEditLivestockBreeding(data){
            console.log(data);
        },
        generateLivestockOptions(farmerId, livestockTypeId, livestockSex) {
            const livestockOptions = this.livestocks.filter((livestock) => {
                return (
                    livestock.farmerId === farmerId &&
                    livestock.sex === livestockSex &&
                    livestock.livestockTypeId === livestockTypeId
                );
            });

            return livestockOptions.map((livestock) => ({
                name: livestock.livestockTagId,
                code: livestock.livestockTagId,
            }));
        },
        filterLivestocksBySexAndType(livestockSex, livestockTypeId) {
            return this.filteredLivestocks.filter((livestock) => {
                return (
                    livestock.sex === livestockSex &&
                    livestock.livestockTypeId === livestockTypeId
                );
            });
        },
        addNewLivestockBreeding(livestockBreeding) {
            console.log(livestockBreeding);
        },
        filterLivestocksForBreeding(farmerId, livetockTypeId, livestockSex){
            const filteredLivestocks = this.livestocks.filter((livestock) => {
                return (
                    livestock.farmerId === farmerId &&
                    livestock.sex === livestockSex &&
                    livestock.livestockTypeId === livetockTypeId
                );
            });

            return filteredLivestocks.map((livestock)=>({
                name: livestock.livestockTagId,
                code: livestock.livestockTagId,
            }))
        }
    },
    watch: {
        "livestockBreeding.farmerId"(newVal, oldVal) {
            this.filteredLivestocks = this.livestocks.filter(
                (livestock) => livestock.farmerId === newVal
            );
            this.livestockBreeding.livestockTypeId = "";
            this.livestockBreeding.maleLivestockTagId = "";
            this.livestockBreeding.femaleLivestockTagId = "";
        },
        "livestockBreeding.livestockTypeId"(newVal, oldVal) {
            const maleLivestocks = this.filterLivestocksBySexAndType(
                "Male",
                newVal
            );
            this.maleLivestocksOptions = maleLivestocks.map((livestock) => ({
                name: livestock.livestockTagId,
                code: livestock.livestockTagId,
            }));

            const femaleLivestocks = this.filterLivestocksBySexAndType(
                "Female",
                newVal
            );
            this.femaleLivestockOptions = femaleLivestocks.map((livestock) => ({
                name: livestock.livestockTagId,
                code: livestock.livestockTagId,
            }));
        },
    },
};
</script>
