<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Dialog
            v-model:visible="newLivestockTypeDialog"
            modal
            header="New Livestock Type"
            :style="{ width: '30rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Type Name"
                        class="w-full"
                        id="livestockTypeName"
                        autocomplete="off"
                        v-model="livestockType.livestockTypeName"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        placeholder="Livestock Type Uses"
                        class="w-full"
                        v-model="livestockType.livestockTypeUses"
                        rows="10"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="newLivestockTypeDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock Type"
                    @click="addNewLivestockType(livestockType)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockTypeDialog"
            modal
            header="Livestock Type Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-between pr-4">
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="getImagePath(viewlivestockType.id)"
                        :alt="getLivestockType(viewlivestockType.id)"
                    />
                </div>
            </div>
            <div class="mt-3 formgrid grid-nogutter h-24 rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        placeholder="Livestock Type Name"
                        class="w-full"
                        id="livestockTypeName"
                        autocomplete="off"
                        v-model="viewlivestockType.livestockTypeName"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        placeholder="Livestock Type Uses"
                        class="w-full"
                        v-model="viewlivestockType.livestockTypeUses"
                        rows="5"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="viewLivestockTypeDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="saveEditLivestockType(viewlivestockType)"
                ></Button>
            </div>
        </Dialog>
        <DataTable
            v-model:filters="filters"
            :value="livestockTypes"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :globalFilterFields="['livestockTypeName', 'livestockTypeUses']"
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
                        @click="newLivestockTypeDialog = true"
                    />
                </div>
            </template>
            <template #empty> No livestock type found. </template>
            <template #loading>
                Loading livestock type data. Please wait...
            </template>
            <Column
                field="livestockTypeName"
                header="Livestock Type"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    <div class="flex gap-2 align-items-center">
                        <Avatar
                            :image="getImagePath(data.id)"
                            class="mr-2"
                            shape="circle"
                        />
                        <div class="text-700 font-semibold">
                            {{ data.livestockTypeName }}
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
                field="livestockTypeUses"
                header="Description"
                style="min-width: 12rem"
            >
                <template #body="{ data }">
                    {{ data.livestockTypeUses }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Livestock Uses"
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
                        @click="editLivestockType(slotProps.data)"
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
import { FilterMatchMode } from "primevue/api";

export default {
    data() {
        return {
            filters: null,
            viewLivestockTypeDialog: false,
            newLivestockTypeDialog: false,
            livestockType: {
                livestockTypeName: "",
                livestockTypeUses: "",
            },
            viewlivestockType: {
                id: "",
                livestockTypeName: "",
                livestockTypeUses: "",
            },
            livestockTypes: [
                {
                    id: "1",
                    livestockTypeName: "Chicken",
                    livestockTypeUses: "Egg and meat production",
                },
                {
                    id: "2",
                    livestockTypeName: "Pig",
                    livestockTypeUses: "Pork production",
                },
                {
                    id: "3",
                    livestockTypeName: "Cattle",
                    livestockTypeUses: "Beef production",
                },
                {
                    id: "4",
                    livestockTypeName: "Carabao",
                    livestockTypeUses:
                        "Plowing, transportation, and milk production",
                },
            ],
        };
    },
    created() {
        this.initFilters();
    },
    methods: {
        clearFilter() {
            this.initFilters();
        },
        initFilters() {
            this.filters = {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                livestockTypeName: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                livestockTypeUses: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
            };
        },
        getLivestockType(type) {
            const livestockType = this.livestockTypes.find(
                (option) => option.id === type
            );
            return livestockType.livestockTypeName;
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
        editLivestockType(data) {
            this.viewlivestockType = data;
            this.viewLivestockTypeDialog = true;
        },
        async addNewLivestockType(livestockType) {
            console.log(livestockType);
        },
        async saveEditLivestockType(livestockType) {
            console.log(livestockType);
        },
    },
};
</script>
