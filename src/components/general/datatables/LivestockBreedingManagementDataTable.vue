<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Toolbar class="mb-2 w-full">
            <template #start>
                <div>
                    <div class="text-3xl font-bold text-700">
                        Livestock Breedings
                    </div>
                </div>
            </template>
            <template v-slot:end>
                <div class="my-1">
                    <router-link :to="{ name: 'AdminLivestockBreedingRecordManagement' }">
                        <Button label="Breeding Records" class="mr-2" text />
                    </router-link>
                    <router-link
                        :to="{ name: 'AdminLivestockPregnancyManagement' }"
                    >
                        <Button label="Pregnancy Records" class="mr-2" text />
                    </router-link>
                </div>
            </template>
        </Toolbar>
        <Dialog
            v-model:visible="viewLivestockBreedingDialog"
            modal
            header="Livestock Breeding Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-between pr-4">
                <div class="flex flex-column gap-3">
                    <div>
                        <div class="text-700 text-sm font-semibold">Farmer</div>
                        <div class="text-700 font-bold">
                            {{ viewLivestockBreeding.farmerName }}
                        </div>
                        <div class="text-sm">
                            {{ viewLivestockBreeding.farmerUserId }}
                        </div>
                    </div>

                    <div>
                        <div class="text-700 text-sm font-semibold">
                            Parent Livestocks
                        </div>
                        <div class="text-700">
                            Father :
                            <span class="font-bold">
                                {{
                                    viewLivestockBreeding.parentMaleLivestockTagId
                                }}
                            </span>
                        </div>
                        <div class="text-700">
                            Mother :
                            <span class="font-bold">
                                {{
                                    viewLivestockBreeding.parentFemaleLivestockTagId
                                }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="text-700 text-sm font-semibold">
                            Offspring Livestock
                        </div>
                        <div class="text-700">
                            <span class="font-bold">
                                {{
                                    viewLivestockBreeding.offspringLivestockTagId
                                }}
                            </span>
                        </div>
                        <small>{{
                            viewLivestockBreeding.actualDeliveryDate
                        }}</small>
                    </div>
                </div>
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="
                            getImagePath(viewLivestockBreeding.livestockTypeId)
                        "
                        :alt="
                            getLivestockType(
                                viewLivestockBreeding.livestockTypeId
                            )
                        "
                    />
                </div>
            </div>
            <div
                class="mt-3 formgrid grid-nogutter h-24 rem overflow-y-auto"
            ></div>
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
                'farmerName',
                'parentMaleLivestockTagId',
                'parentFemaleLivestockTagId',
                'offspringLivestockTagId',
                'livestockType',
                'date',
            ]"
            class="w-full"
            selectionMode="single"
            :metaKeySelection="true"
            @rowSelect="onRowSelect"
        >
            <template #header>
                <div class="flex justify-content-between align-items-center">
                    <InputText
                        v-model="filters['global'].value"
                        placeholder="Keyword Search"
                    />
                </div>
            </template>
            <template #empty> No livestock breedings found. </template>
            <template #loading>
                Loading livestock breedings data. Please wait...
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
                field="parentMaleLivestockTagId"
                header="Male Parent"
                style="min-width: 9rem"
            >
                <template #body="{ data }">
                    {{ data.parentMaleLivestockTagId }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Male Parent"
                    />
                </template>
            </Column>
            <Column
                field="parentFemaleLivestockTagId"
                header="Female Parent"
                style="min-width: 9rem"
            >
                <template #body="{ data }">
                    {{ data.parentFemaleLivestockTagId }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Female Parent"
                    />
                </template>
            </Column>
            <Column
                field="offspringLivestockTagId"
                header="Offspring"
                style="min-width: 9rem"
            >
                <template #body="{ data }">
                    {{ data.offspringLivestockTagId }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Offspring"
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
        </DataTable>
    </div>
</template>

<script>
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

            livestockVaccinations: null,

            livestockBreedings: null,
            viewLivestockBreedingDialog: false,
            viewLivestockBreeding: {
                id: "",
                breedingId: "",
                livestockId: "",
                livestockTagId: "",
                livestockTypeId: "",
                outcome: "",
                pregnancyStartDate: null,
                expectedDeliveryDate: null,
                actualDeliveryDate: null,
            },
            filters: null,
            loading: true,
        };
    },
    created() {
        this.initFilters();
    },
    mounted() {
        BreedingService.getBreedingParentOffspringData().then((data) => {
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
                farmerName: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                parentMaleLivestockTagId: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                parentFemaleLivestockTagId: {
                    value: null,
                    matchMode: FilterMatchMode.CONTAINS,
                },
                offspringLivestockTagId: {
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
                d.date = new Date(d.actualDeliveryDate);
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
        onRowSelect(event) {
            this.viewLivestockBreeding = event.data;
            this.viewLivestockBreedingDialog = true;
            // alert('hello')
        },
    },
};
</script>
