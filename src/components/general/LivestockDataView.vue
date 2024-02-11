<template>
    <div class="card">
        <Dialog
            v-model:visible="newLivestockDialog"
            modal
            header="New Livestock"
            :style="{ width: '22rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
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
                        :options="livestockTypesOptions"
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
                        :options="getLivestockBreedOptions(livestock.livestockTypeId)"
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
                        :options="getLivestockAgeClassOptions(livestock.livestockTypeId)"
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
            :style="{ width: '22rem' }"
        >
            <div>
                <img
                    class="block xl:block mx-auto border-round h-5rem"
                    :src="getImagePath(viewLivestock.livestockTypeId)"
                    :alt="getLivestockType(viewLivestock.livestockTypeId)"
                />
            </div>
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
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
                        :options="livestockTypesOptions"
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
                            getLivestockBreedOptions(viewLivestock.livestockTypeId)
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
                        v-model="viewLivestock.ageDays"
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
        <DataView
            :value="livestocks"
            :sortOrder="sortOrder"
            :sortField="sortField"
        >
            <template #header>
                <div class="flex justify-content-between">
                    <div class="text-3xl font-semibold">Livestocks</div>
                    <Button label="New" @click="newLivestockDialog = true" />
                </div>
            </template>
            <template #list="slotProps">
                <div class="grid grid-nogutter">
                    <div
                        v-for="(item, index) in slotProps.items"
                        :key="index"
                        class="col-12"
                    >
                        <div
                            class="flex sm:align-items-center p-4 gap-3"
                            :class="{
                                'border-top-1 surface-border': index !== 0,
                            }"
                        >
                            <div class="w-4rem relative">
                                <img
                                    class="block xl:block mx-auto border-round w-full"
                                    :src="getImagePath(item.livestockTypeId)"
                                    :alt="item.livestockTypeId"
                                />
                            </div>
                            <div
                                class="flex flex-column md:flex-row justify-content-between md:align-items-center flex-1 gap-4"
                            >
                                <div
                                    class="flex flex-column justify-content-between align-items-start gap-2"
                                >
                                    <div class=" w-full">
                                        <div
                                            class="flex justify-content-between"
                                        >
                                            <div
                                                class="font-medium text-secondary text-sm"
                                            >
                                                {{
                                                    getLivestockType(
                                                        item.livestockTypeId
                                                    )
                                                }}
                                            </div>
                                            <div
                                                class="font-medium text-secondary text-sm"
                                            >
                                                {{
                                                    getLivestockAgeClass(
                                                        item.livestockTypeId,
                                                        item.livestockAgeClassId
                                                    )
                                                }}
                                            </div>
                                        </div>
                                        <div
                                            class="text-lg font-bold text-900 mt-2"
                                        >
                                            {{ item.livestockTagId }}
                                        </div>
                                    </div>
                                    <Button
                                        icon="pi pi-pencil"
                                        label="View Info"
                                        severity="secondary"
                                        outlined
                                        class="w-full"
                                        @click="viewLivestockDetails(item.id)"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </DataView>
    </div>
</template>

<script>
import InputText from "primevue/inputtext";

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
            livestocks: [
                {
                    id: "1",
                    livestockTagId: "CTL-101",
                    livestockTypeId: "3",
                    livestockBreedId: "7",
                    livestockAgeClassId: "12",
                    ageDays: "4 Days",
                    sex: "Male",
                    breedingEligibility: "Not Age-Suited",
                    dateOfBirth: "2024-2-6",
                    livestockHealthStatus: "Alive",
                },
                {
                    id: "2",
                    livestockTagId: "PG-101",
                    livestockTypeId: "2",
                    livestockBreedId: "5",
                    livestockAgeClassId: "6",
                    ageDays: "10 Days",
                    sex: "Male",
                    breedingEligibility: "Not Age-Suited",
                    dateOfBirth: "2024-1-31",
                    livestockHealthStatus: "Alive",
                },
                {
                    id: "3",
                    livestockTagId: "PG-102",
                    livestockTypeId: "2",
                    livestockBreedId: "5",
                    livestockAgeClassId: "6",
                    ageDays: "10 Days",
                    sex: "Female",
                    breedingEligibility: "Not Age-Suited",
                    dateOfBirth: "2024-1-31",
                    livestockHealthStatus: "Alive",
                },
            ],
        };
    },
    methods: {
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
        getLivestockType(type) {
            const livestockType = this.livestockTypesOptions.find(
                (option) => option.code === type
            );
            return livestockType.name;
        },
        getLivestockAgeClass(livestockTypeId, livestockAgeClassId) {
            const livestockAgeClass = this.livestockAgeClasses[
                livestockTypeId
            ].find((option) => option.code === livestockAgeClassId);
            if (livestockAgeClass) {
                console.log(
                    "Selected livestock age class:",
                    livestockAgeClass.name
                );
                // You can use livestockAgeClass.name for further processing
            } else {
                console.warn("Livestock age class not found for code:", newVal);
            }
            return livestockAgeClass.name;
        },
        viewLivestockDetails(id) {
            console.log(id);
            this.viewLivestock = this.livestocks.find(
                (livestock) => livestock.id === id
            );
            this.viewLivestockDialog = true;
        },
        getLivestockBreedOptions(livestockTypeId) {
            return this.livestockBreeds[livestockTypeId];
        },
        getLivestockAgeClassOptions(livestockTypeId) {
            return this.livestockAgeClasses[livestockTypeId];
        },
        async saveEditLivestock(livestock) {
            console.log(JSON.stringify(livestock));
        },
        async addNewLivestock(livestock) {
            console.log(JSON.stringify(livestock));
        }
    },
    watch: {
        "livestock.livestockTypeId"(newVal, oldVal) {
            this.livestockBreedsOptions = this.livestockBreeds[newVal.code];
            this.livestockAgeClassesOptions =
                this.livestockAgeClasses[newVal.code];
        },
    },
    components: { InputText },
};
</script>
