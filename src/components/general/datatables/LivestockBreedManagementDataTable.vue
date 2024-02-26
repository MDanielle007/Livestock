<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Dialog
            v-model:visible="newLivestockBreedDialog"
            modal
            header="New Livestock Breed"
            :style="{ width: '30rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockType"
                        v-model="livestockBreed.livestockTypeId"
                        :options="livestockTypes"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Type"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Breed Name"
                        class="w-full"
                        id="livestockTypeName"
                        autocomplete="off"
                        v-model="livestockBreed.livestockBreedName"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        placeholder="Livestock Breed Description"
                        class="w-full"
                        v-model="livestockBreed.livestockBreedDescription"
                        rows="10"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="newLivestockBreedDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock Breed"
                    @click="addNewLivestockBreed(livestockBreed)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockBreedDialog"
            modal
            header="Livestock Breed Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-center pr-4">
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="getImagePath(viewlivestockBreed.livestockTypeId)"
                        :alt="getLivestockType(viewlivestockBreed.livestockTypeId)"
                    />
                </div>
            </div>
            <div class="mt-3 formgrid grid-nogutter h-24 rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockType"
                        v-model="viewlivestockBreed.livestockTypeId"
                        :options="livestockTypes"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock Type"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Breed Name"
                        class="w-full"
                        id="livestockTypeName"
                        autocomplete="off"
                        v-model="viewlivestockBreed.livestockBreedName"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        placeholder="Livestock Breed Description"
                        class="w-full"
                        v-model="viewlivestockBreed.livestockBreedDescription"
                        rows="10"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="viewLivestockBreedDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="saveEditLivestockBreed(viewlivestockBreed)"
                ></Button>
            </div>
        </Dialog>
        <DataTable
            v-model:filters="filters"
            :value="livestockBreeds"
            :loading="loading"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :globalFilterFields="['livestockBreedName', 'livestockBreedDescription','livestockType']"
            class="w-full"
        >
            <template #header>
                <div class="flex justify-content-between align-items-center">
                    <InputText
                        v-model="filters['global'].value"
                        placeholder="Keyword Search"
                    />
                    <Button
                        label="New Livestock Breed"
                        class="p-button-success mr-2"
                        @click="newLivestockBreedDialog = true"
                    />
                </div>
            </template>
            <template #empty> No livestock type found. </template>
            <template #loading>
                Loading livestock type data. Please wait...
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
                field="livestockBreedName"
                header="Breed Name"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    {{ data.livestockBreedName }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Livestock Breed Name"
                    />
                </template>
            </Column>
            <Column
                field="livestockBreedDescription"
                header="Description"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    {{ data.livestockBreedDescription }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Breed Description"
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
                        @click="editLivestockBreed(slotProps.data)"
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
            viewLivestockBreedDialog: false,
            newLivestockBreedDialog: false,
            livestockBreed: {
                livestockBreedName: "",
                livestockBreedDescription: "",
                livestockTypeId: "",
            },
            viewlivestockBreed: {
                id: "",
                livestockBreedName: "",
                livestockBreedDescription: "",
                livestockTypeId: "",
            },
            livestockBreeds: null,
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
        LivestockService.getLivestockBreeds().then((data) => {
            this.livestockBreeds = this.getLivestockBreeds(data);
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
                livestockBreedName: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockBreedDescription: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockType:{
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                }
            };
        },
        getLivestockBreeds(data){
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
        editLivestockBreed(data) {
            this.viewlivestockBreed = data;
            this.viewLivestockBreedDialog = true;
        },
        async addNewLivestockBreed(livestockBreed) {
            console.log(livestockBreed);
        },
        async saveEditLivestockBreed(livestockBreed) {
            console.log(livestockBreed);
        },
    },
};
</script>
