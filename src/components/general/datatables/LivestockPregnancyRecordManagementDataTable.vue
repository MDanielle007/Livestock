<template>
    <div
        class="bg-white border-round-lg border-1 border-300 p-3 flex flex-column gap-1 justify-content-center align-items-center"
    >
        <Dialog
            v-model:visible="newLivestockPregnancyDialog"
            modal
            header="New Livestock Breeding"
            :style="{ width: '30rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="farmerId"
                        v-model="livestockPregnancy.farmerId"
                        :options="farmers"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Farmer"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="farmerId"
                        v-model="livestockPregnancy.breedingId"
                        :options="
                            getLivestockBreedingRecordOptions(
                                filteredLivestocksBreedings
                            )
                        "
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Breedings"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Panel
                        v-if="livestockPregnancy.breedingId"
                        toggleable
                        collapsed
                        class="w-full"
                    >
                        <template #header>
                            Breeding Record Selected Details
                        </template>
                        <div class="field col-12 flex align-items-center gap-2">
                            <Calendar
                                disabled
                                inputId="breedingDate"
                                v-model="selectedLivestocksBreeding.breedDate"
                                class="w-full"
                                placeholder="Select Breeding Date"
                                dateFormat="yy-mm-dd"
                                showIcon
                            />
                        </div>

                        <div class="field col-12 flex align-items-center gap-2">
                            <Dropdown
                                disabled
                                inputId="livestockType"
                                v-model="
                                    selectedLivestocksBreeding.livestockTypeId
                                "
                                :options="livestockTypes"
                                optionValue="code"
                                optionLabel="name"
                                class="w-full"
                                placeholder="Select Livestock Type"
                            ></Dropdown>
                        </div>
                        <div class="field col-12 flex gap-3">
                            <InputText
                                disabled
                                inputId="maleLivestockTagId"
                                v-model="
                                    selectedLivestocksBreeding.maleLivestockTagId
                                "
                                class="w-6"
                                placeholder="Male"
                            ></InputText>
                            <InputText
                                disabled
                                inputId="femaleLivestockTagId"
                                v-model="
                                    selectedLivestocksBreeding.femaleLivestockTagId
                                "
                                class="w-6"
                                placeholder="Female"
                            ></InputText>
                        </div>
                        <div
                            v-if="livestockBreeding.breedingId"
                            class="field col-12 flex align-items-center gap-2"
                        >
                            <Dropdown
                                disabled
                                inputId="breedResult"
                                v-model="selectedLivestocksBreeding.breedResult"
                                :options="breedingResultsOptions"
                                optionValue="code"
                                optionLabel="name"
                                class="w-full"
                                placeholder="Breeding Result"
                            ></Dropdown>
                        </div>
                    </Panel>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        inputId="livestockTypeId"
                        v-model="livestockPregnancy.livestockTagId"
                        class="w-full"
                        placeholder="Female Livestock"
                    ></InputText>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="outcome"
                        v-model="livestockPregnancy.outcome"
                        :options="outcomeOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Pregancy Outcome"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="pregnancyStartDate"
                        v-model="livestockPregnancy.pregnancyStartDate"
                        class="w-full"
                        placeholder="Select Pregnancy Start Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="expectedDeliveryDate"
                        v-model="livestockPregnancy.expectedDeliveryDate"
                        class="w-full"
                        placeholder="Select Pregnancy Expected Delivery Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div
                    v-if="successfulPregnancy"
                    class="field col-12 flex flex-column gap-2"
                >
                    <small class="font-semibold"
                        >Actual Livestock Delivery Date</small
                    >
                    <Calendar
                        inputId="actualDeliveryDate"
                        v-model="viewLivestockPregnancy.actualDeliveryDate"
                        class="w-full"
                        placeholder="Select Delivery Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div
                    v-if="successfulPregnancy"
                    class="field col-12 flex flex-column gap-2"
                >
                    <small class="font-semibold">Male OffSprings</small>
                    <InputNumber
                        v-model="successfulPregnancyDetails.maleOffsprings"
                        inputId="maleOffsprings"
                        placeholder="Number of Male Offsprings"
                    />
                </div>
                <div
                    v-if="successfulPregnancy"
                    class="field col-12 flex flex-column gap-2"
                >
                    <small class="font-semibold">Female OffSprings</small>
                    <InputNumber
                        v-model="successfulPregnancyDetails.femaleOffsprings"
                        inputId="femaleOffsprings"
                        placeholder="Number of Female Offsprings"
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="newLivestockPregnancyDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock"
                    @click="addNewLivestockPregnancy(livestockPregnancy)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockPregnancyDialog"
            modal
            header="Livestock Pregnancy Details"
            :style="{ width: '30rem' }"
        >
            <div class="flex align-items-center justify-content-between pr-4">
                <div>
                    <img
                        class="block xl:block mx-auto border-round h-5rem"
                        :src="
                            getImagePath(viewLivestockPregnancy.livestockTypeId)
                        "
                        :alt="
                            getLivestockType(
                                viewLivestockPregnancy.livestockTypeId
                            )
                        "
                    />
                </div>
            </div>
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="farmerId"
                        v-model="viewLivestockPregnancy.farmerId"
                        :options="farmers"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Farmer"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="farmerId"
                        v-model="viewLivestockPregnancy.breedingId"
                        :options="
                            getLivestockBreedingRecordOptions(
                                filteredLivestocksBreedings
                            )
                        "
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Breedings"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Panel
                        v-if="viewLivestockPregnancy.breedingId"
                        toggleable
                        collapsed
                        class="w-full"
                    >
                        <template #header>
                            Breeding Record Selected Details
                        </template>
                        <div class="field col-12 flex align-items-center gap-2">
                            <Calendar
                                disabled
                                inputId="breedingDate"
                                v-model="selectedLivestocksBreeding.breedDate"
                                class="w-full"
                                placeholder="Select Breeding Date"
                                dateFormat="yy-mm-dd"
                                showIcon
                            />
                        </div>

                        <div class="field col-12 flex align-items-center gap-2">
                            <Dropdown
                                disabled
                                inputId="livestockType"
                                v-model="
                                    selectedLivestocksBreeding.livestockTypeId
                                "
                                :options="livestockTypes"
                                optionValue="code"
                                optionLabel="name"
                                class="w-full"
                                placeholder="Select Livestock Type"
                            ></Dropdown>
                        </div>
                        <div class="field col-12 flex gap-3">
                            <InputText
                                disabled
                                inputId="maleLivestockTagId"
                                v-model="
                                    selectedLivestocksBreeding.maleLivestockTagId
                                "
                                class="w-6"
                                placeholder="Male"
                            ></InputText>
                            <InputText
                                disabled
                                inputId="femaleLivestockTagId"
                                v-model="
                                    selectedLivestocksBreeding.femaleLivestockTagId
                                "
                                class="w-6"
                                placeholder="Female"
                            ></InputText>
                        </div>
                        <div
                            v-if="livestockBreeding.breedingId"
                            class="field col-12 flex align-items-center gap-2"
                        >
                            <Dropdown
                                disabled
                                inputId="breedResult"
                                v-model="selectedLivestocksBreeding.breedResult"
                                :options="breedingResultsOptions"
                                optionValue="code"
                                optionLabel="name"
                                class="w-full"
                                placeholder="Breeding Result"
                            ></Dropdown>
                        </div>
                    </Panel>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        inputId="livestockTypeId"
                        v-model="viewLivestockPregnancy.livestockTagId"
                        class="w-full"
                        placeholder="Female Livestock"
                    ></InputText>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="outcome"
                        v-model="viewLivestockPregnancy.outcome"
                        :options="outcomeOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Pregancy Outcome"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="pregnancyStartDate"
                        v-model="viewLivestockPregnancy.pregnancyStartDate"
                        class="w-full"
                        placeholder="Select Pregnancy Start Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="expectedDeliveryDate"
                        v-model="viewLivestockPregnancy.expectedDeliveryDate"
                        class="w-full"
                        placeholder="Select Pregnancy Expected Delivery Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div
                    v-if="successfulPregnancy"
                    class="field col-12 flex flex-column gap-2"
                >
                    <small class="font-semibold"
                        >Actual Livestock Delivery Date</small
                    >
                    <Calendar
                        inputId="actualDeliveryDate"
                        v-model="viewLivestockPregnancy.actualDeliveryDate"
                        class="w-full"
                        placeholder="Select Delivery Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="viewLivestockPregnancyDialog = false"
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
            :value="livestockPregnancies"
            paginator
            :rows="10"
            dataKey="id"
            filterDisplay="menu"
            :loading="loading"
            :globalFilterFields="[
                'farmerUserId',
                'livestockTagId',
                'outcome',
                'livestockType',
                'pregnancyStartDate',
                'expectedDeliveryDate',
                'actualDeliveryDate',
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
                        label="New Livestock Pregnancy"
                        class="p-button-success mr-2"
                        @click="newLivestockPregnancyDialog = true"
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
                field="livestockTagId"
                header="Livestock"
                style="min-width: 6rem"
            >
                <template #body="{ data }">
                    {{ data.livestockTagId }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Livestock"
                    />
                </template>
            </Column>
            <Column field="outcome" header="Outcome" style="min-width: 6rem">
                <template #body="{ data }">
                    <Tag
                        :value="data.outcome"
                        :severity="getPregnancySeverity(data.outcome)"
                    ></Tag>
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Outcome"
                    />
                </template>
            </Column>

            <Column
                field="pregnancyStartDate"
                header="Start Date"
                style="min-width: 6rem"
            >
                <template #body="{ data }">
                    {{ formatDate(data.pregnancyStartDate) }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Start Date"
                    />
                </template>
            </Column>
            <Column
                field="actualDeliveryDate"
                header="Actual Delivery"
                style="min-width: 6rem"
            >
                <template #body="{ data }">
                    {{
                        data.actualDeliveryDate
                            ? formatDate(data.actualDeliveryDate)
                            : "Still Pregnant"
                    }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText
                        v-model="filterModel.value"
                        type="text"
                        class="p-column-filter"
                        placeholder="Search by Actual Delivery Date"
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
                        @click="editLivestockPregnancy(slotProps.data)"
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
            livestockBreeding: {
                farmerId: "",
                livestockTypeId: "",
                maleLivestockTagId: "",
                femaleLivestockTagId: "",
                breedResult: "",
                breedAdditionalNotes: "",
                breedDate: "",
            },

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

            viewLivestockPregnancyDialog: false,
            newLivestockPregnancyDialog: false,
            livestockPregnancy: {
                id: "",
                breedingId: "",
                livestockId: "",
                livestockTagId: "",
                livestockTypeId: "",
                outcome: "",
                pregnancyStartDate: "",
                expectedDeliveryDate: null,
                actualDeliveryDate: "",
                farmerId: "",
            },
            viewLivestockPregnancy: {
                id: "",
                breedingId: "",
                livestockId: "",
                livestockTagId: "",
                livestockTypeId: "",
                outcome: "",
                pregnancyStartDate: "",
                expectedDeliveryDate: null,
                actualDeliveryDate: "",
                farmerId: "",
                farmerName: "",
                farmerUserId: "",
            },
            successfulPregnancyDetails: {
                maleOffsprings: 0,
                femaleOffsprings: 0,
            },
            successfulPregnancy: false,
            outcomeOptions: [
                {
                    name: "Successful",
                    code: "Successful",
                },
                {
                    name: "Pending",
                    code: "Pending",
                },
                {
                    name: "Miscarriage",
                    code: "Miscarriage",
                },
            ],
            livestockPregnancies: null,
            filteredLivestocksBreedings: null,
            selectedLivestocksBreeding: {
                livestockTypeId: "",
                maleLivestockTagId: "",
                femaleLivestockTagId: "",
                breedResult: "",
                breedAdditionalNotes: "",
                breedDate: "",
            },

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
            this.loading = false;
        });

        BreedingService.getLivestockBreedingData().then((data) => {
            this.livestockBreedings = this.getLivestockBreedings(data);
            this.loading = false;
        });

        BreedingService.getLivestockPregnancyData().then((data) => {
            this.livestockPregnancies = this.getLivestockPregnancies(data);
            this.loading = false;
        });
    },
    methods: {
        getPregnancySeverity(sev) {
            switch (sev) {
                case "Successful":
                    return "success";
                case "Pending":
                    return "warning";
                case "Miscarriage":
                    return "error";
                default:
                    return "info";
            }
        },
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
        getLivestockPregnancies(data) {
            return [...(data || [])].map((d) => {
                d.pregnancyStartDate = new Date(d.pregnancyStartDate);
                d.expectedDeliveryDate = d.expectedDeliveryDate
                    ? new Date(d.expectedDeliveryDate)
                    : null;
                d.actualDeliveryDate = d.actualDeliveryDate
                    ? new Date(d.actualDeliveryDate)
                    : null;
                // console.log(d)
                d.livestockType = this.getLivestockType(d.livestockTypeId);

                return d;
            });
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
        editLivestockPregnancy(data) {
            this.viewLivestockPregnancy = data;
            this.viewLivestockPregnancyDialog = true;
        },
        saveEditLivestockBreeding(data) {
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

            console.log(livestockOptions);

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
        addNewLivestockPregnancy(livestockPregnancy) {
            console.log(livestockPregnancy);
        },
        filterLivestocksForBreeding(farmerId, livetockTypeId, livestockSex) {
            const filteredLivestocks = this.livestocks.filter((livestock) => {
                return (
                    livestock.farmerId === farmerId &&
                    livestock.sex === livestockSex &&
                    livestock.livestockTypeId === livetockTypeId
                );
            });

            return filteredLivestocks.map((livestock) => ({
                name: livestock.livestockTagId,
                code: livestock.livestockTagId,
            }));
        },
        getLivestockBreedingRecordOptions(data) {
            if (data && Array.isArray(data)) {
                // Check if data is not null and is an array
                const options = data.map((d) => ({
                    name: `${d.maleLivestockTagId} & ${d.femaleLivestockTagId}`,
                    code: d.id,
                }));

                console.log(options);

                return options;
            } else {
                return []; // Return an empty array if data is null or not an array
            }
        },
        getFarmerLivestockByTagId(tagId, userId) {
            return this.livestocks.find((livestock) => {
                return (
                    livestock.livestockTagId === tagId &&
                    livestock.farmerId === userId
                );
            });
        },
        updateFilteredLivestocks(farmerId) {
            this.filteredLivestocks = this.livestocks.filter(
                (livestock) => livestock.farmerId === farmerId
            );

            this.filteredLivestocksBreedings = this.livestockBreedings.filter(
                (breedings) => breedings.farmerId === farmerId
            );
        },
        updateSelectedLivestockBreedings(id) {
            this.selectedLivestocksBreeding =
                this.filteredLivestocksBreedings.find((breedings) => {
                    return breedings.id === id;
                });
        },
        setLivestockPregnancy(id, tagId, date) {
            this.livestockPregnancy.livestockId = id;
            this.livestockPregnancy.livestockTagId = tagId;
            this.livestockPregnancy.pregnancyStartDate = date;
        },
        setSuccessfulPregnancy(outcome){
            if (outcome === "Successful") {
                this.successfulPregnancy = true;
            }else{
                this.successfulPregnancy = false;
            }
        }
    },
    watch: {
        "livestockPregnancy.farmerId"(newVal, oldVal) {
            this.updateFilteredLivestocks(newVal);
        },
        "viewLivestockPregnancy.farmerId"(newVal, oldVal) {
            this.updateFilteredLivestocks(newVal);
        },
        "livestockPregnancy.breedingId"(newVal, oldVal) {
            this.updateSelectedLivestockBreedings(newVal);

            const femaleLivestock = this.getFarmerLivestockByTagId(
                this.selectedLivestocksBreeding.femaleLivestockTagId,
                this.livestockPregnancy.farmerId
            );
            
            this.setLivestockPregnancy(femaleLivestock.id, femaleLivestock.livestockTagId, this.selectedLivestocksBreeding.breedDate)
        },
        "viewLivestockPregnancy.breedingId"(newVal, oldVal) {
            this.updateSelectedLivestockBreedings(newVal);

            const femaleLivestock = this.getFarmerLivestockByTagId(
                this.selectedLivestocksBreeding.femaleLivestockTagId,
                this.viewLivestockPregnancy.farmerId
            );

            this.setLivestockPregnancy(femaleLivestock.id, femaleLivestock.livestockTagId, this.selectedLivestocksBreeding.breedDate)
        },
        "viewLivestockPregnancy.outcome"(newVal, oldVal) {
            this.setSuccessfulPregnancy(newVal);
        },
        "livestockPregnancy.outcome"(newVal, oldVal) {
            this.setSuccessfulPregnancy(newVal);
        },
    },
};
</script>
