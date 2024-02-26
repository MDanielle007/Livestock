<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Toolbar class="mb-2 w-full">
            <template #start>
                <div>
                    <div class="text-3xl font-bold text-700">Livestocks</div>
                </div>
            </template>

            <template v-slot:end>
                <div class="my-1">
                    <router-link :to="{ name: 'AdminLivestockTypeMonitoring' }">
                        <Button
                            label="Livestock Types"
                            class="mr-2"
                            text
                        />
                    </router-link>
                    <router-link :to="{ name: 'AdminLivestockBreedMonitoring' }">
                        <Button
                            label="Livestock Breeds"
                            class="mr-2"
                            text
                        />
                    </router-link>
                    <router-link :to="{ name: 'AdminLivestockAgeClassification' }">
                        <Button
                            label="Livestock Age Classification"
                            class="mr-2"
                            text    
                        />
                    </router-link>
                </div>
            </template>
        </Toolbar>
        <Dialog
            v-model:visible="newLivestockDialog"
            modal
            header="New Livestock"
            :style="{ width: '30rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        v-model="livestock.farmerId"
                        :options="farmers"
                        filter
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select a Farmer"
                        class="w-full md:w-14rem"
                    >
                    </Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Tag ID"
                        class="w-full"
                        id="livestockTagId"
                        autocomplete="off"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="birthDate"
                        v-model="livestock.dateOfBirth"
                        class="w-full"
                        placeholder="Select Livestock Birth Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockType"
                        v-model="livestock.livestockTypeId"
                        :options="livestockTypes"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Type"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockBreed"
                        v-model="livestock.livestockBreedId"
                        :options="
                            getLivestockBreedOptions(livestock.livestockTypeId)
                        "
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Breed"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockAgeClass"
                        v-model="livestock.livestockAgeClassId"
                        :options="
                            getLivestockAgeClassOptions(
                                livestock.livestockTypeId
                            )
                        "
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Age Classification"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputNumber
                        v-model="livestock.ageDays"
                        placeholder="Livestock Age (Days)"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockSex"
                        v-model="livestock.sex"
                        :options="livestockSex"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Sex"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockSex"
                        v-model="livestock.livestockHealthStatus"
                        :options="livestockHealthStatuses"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Health Status"
                    ></Dropdown>
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="newLivestockDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock"
                    @click="addNewLivestock(livestock)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockDialog"
            modal
            header="Livestock Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-between pr-4">
                <div class="flex justify-content-between">
                    <div>
                        <div class="text-700 text-sm font-semibold">Farmer</div>
                        <div class="text-700 font-bold">
                            {{ viewLivestock.farmerName }}
                        </div>
                        <div class="text-sm">
                            {{ viewLivestock.farmerUserId }}
                        </div>
                    </div>
                </div>
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="getImagePath(viewLivestock.livestockTypeId)"
                        :alt="getLivestockType(viewLivestock.livestockTypeId)"
                    />
                </div>
            </div>
            <div class="mt-3 formgrid grid-nogutter h-24 rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Tag ID"
                        class="w-full"
                        id="livestockTagId"
                        autocomplete="off"
                        v-model="viewLivestock.livestockTagId"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="birthDate"
                        v-model="viewLivestock.dateOfBirth"
                        class="w-full"
                        placeholder="Select Livestock Birth Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockType"
                        v-model="viewLivestock.livestockTypeId"
                        :options="livestockTypes"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Type"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockBreed"
                        v-model="viewLivestock.livestockBreedId"
                        :options="
                            getLivestockBreedOptions(
                                viewLivestock.livestockTypeId
                            )
                        "
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Breed"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockAgeClass"
                        v-model="viewLivestock.livestockAgeClassId"
                        :options="
                            getLivestockAgeClassOptions(
                                viewLivestock.livestockTypeId
                            )
                        "
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Age Classification"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="viewLivestock.age"
                        placeholder="Livestock Age (Days)"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockSex"
                        v-model="viewLivestock.sex"
                        :options="livestockSex"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Sex"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockSex"
                        v-model="viewLivestock.livestockHealthStatus"
                        :options="livestockHealthStatuses"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Health Status"
                    ></Dropdown>
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="viewLivestockDialog = false"
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
            :value="livestocks"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :loading="loading"
            :globalFilterFields="[
                'farmerName',
                'livestockTagId',
                'livestockType',
                'livestockAgeClass',
                'age',
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
                        label="New Livestock"
                        class="p-button-success mr-2"
                        @click="newLivestockDialog = true"
                    />
                </div>
            </template>
            <template #empty> No livestock found. </template>
            <template #loading>
                Loading livestocks data. Please wait...
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
                    {{ data.livestockType }}
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
                field="livestockAgeClass"
                header="Age Classification"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    {{ data.livestockAgeClass }}
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
            <Column field="age" header="Age" style="min-width: 5rem">
                <template #body="{ data }">
                    {{ data.age }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Age"
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
                        @click="editLivestock(slotProps.data)"
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
            viewLivestockDialog: false,
            newLivestockDialog: false,
            livestock: {
                livestockTagId: "",
                livestockTypeId: "",
                livestockBreedId: "",
                livestockAgeClassId: "",
                ageDays: null,
                sex: "",
                breedingEligibility: "",
                dateOfBirth: "",
                livestockHealthStatus: "",
                farmerId: "",
            },
            viewLivestock: {
                id: "",
                livestockTagId: "",
                livestockTypeId: "",
                livestockBreedId: "",
                livestockAgeClassId: "",
                ageDays: "",
                sex: "",
                breedingEligibility: "",
                dateOfBirth: "",
                livestockHealthStatus: "",
                farmerId: "",
                farmerUserId: "",
                farmerName: "",
            },
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
            livestockBreeds: {
                1: [
                    {
                        name: "Native Chicken",
                        code: "1",
                    },
                    {
                        name: "Rhode Island Red",
                        code: "2",
                    },
                    {
                        name: "Leghorn",
                        code: "3",
                    },
                ],
                2: [
                    {
                        name: "Duroc",
                        code: "4",
                    },
                    {
                        name: "Landrace",
                        code: "5",
                    },
                    {
                        name: "Berk shire",
                        code: "6",
                    },
                ],
                3: [
                    {
                        name: "Holstein Friesian",
                        code: "7",
                    },
                    {
                        name: "Brahman",
                        code: "8",
                    },
                ],
            },
            livestockAgeClasses: {
                1: [
                    {
                        name: "Chick",
                        code: "1",
                    },
                    {
                        name: "Pullet",
                        code: "2",
                    },
                    {
                        name: "Cockerel",
                        code: "3",
                    },
                    {
                        name: "Rooster",
                        code: "4",
                    },
                    {
                        name: "Hen",
                        code: "5",
                    },
                ],
                2: [
                    {
                        name: "Piglet",
                        code: "6",
                    },
                    {
                        name: "Weaner",
                        code: "7",
                    },
                    {
                        name: "Grower",
                        code: "8",
                    },
                    {
                        name: "Finisher",
                        code: "9",
                    },
                    {
                        name: "Sow",
                        code: "10",
                    },
                    {
                        name: "Boar",
                        code: "11",
                    },
                ],
                3: [
                    {
                        name: "Calf",
                        code: "12",
                    },
                    {
                        name: "Yearling",
                        code: "13",
                    },
                    {
                        name: "Heifer",
                        code: "14",
                    },
                    {
                        name: "Steer",
                        code: "15",
                    },
                    {
                        name: "Cow",
                        code: "16",
                    },
                    {
                        name: "Bull",
                        code: "17",
                    },
                ],
            },
            livestockSex: [
                {
                    name: "Male",
                    code: "Male",
                },
                {
                    name: "Female",
                    code: "Female",
                },
            ],
            livestockHealthStatuses: [
                {
                    name: "Alive",
                    code: "Alive",
                },
                {
                    name: "Sick",
                    code: "Sick",
                },
                {
                    name: "Dead",
                    code: "Dead",
                },
            ],
            farmers:[
                {
                    name: "Aba Cus",
                    code: "1"
                },
                {
                    name: "Ba Doy",
                    code: "2"
                },
                {
                    name: "Cak E",
                    code: "3"
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
        LivestockService.getLivestockData().then((data) => {
            this.livestocks = this.getLivestocks(data);
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
                livestockTagId: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockType: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockAgeClass: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                age: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
            };
        },
        getLivestocks(data) {
            return [...(data || [])].map((d) => {
                d.dateOfBirth = new Date(d.dateOfBirth);
                d.livestockType = this.getLivestockType(d.livestockTypeId);
                d.livestockAgeClass = this.getLivestockAgeClass(
                    d.livestockTypeId,
                    d.livestockAgeClassId
                );

                return d;
            });
        },
        getLivestockType(type) {
            const livestockType = this.livestockTypes.find(
                (option) => option.code === type
            );
            return livestockType.name;
        },
        getLivestockAgeClass(livestockTypeId, livestockAgeClassId) {
            const livestockAgeClass = this.livestockAgeClasses[
                livestockTypeId
            ].find((option) => option.code === livestockAgeClassId);
            return livestockAgeClass.name;
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
        editLivestock(data) {
            this.viewLivestock = data;
            this.viewLivestockDialog = true;
        },
        getLivestockBreedOptions(livestockTypeId) {
            return this.livestockBreeds[livestockTypeId];
        },
        getLivestockAgeClassOptions(livestockTypeId) {
            return this.livestockAgeClasses[livestockTypeId];
        },
    },
};
</script>
