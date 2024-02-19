<template>
    <div class="card">
        <Dialog
            v-model:visible="newEggProductionDialog"
            modal
            header="New Egg Production"
            :style="{ width: '22rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="dateOfProduction"
                        v-model="eggProduction.dateOfProduction"
                        class="w-full"
                        placeholder="Select Production Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockId"
                        v-model="eggProduction.livestockId"
                        :options="livestockChickenOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputNumber
                        v-model="eggProduction.eggProduced"
                        placeholder="Eggs Produced"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="eggProduction.additionalEggProdNotes"
                        placeholder="Additional Egg Production Notes"
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
                    @click="newEggProductionDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="addNewEggProduction(eggProduction)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewEggProductionDialog"
            modal
            header="Egg Production Details"
            :style="{ width: '22rem' }"
        >
            <div>
                <img
                    class="block xl:block mx-auto border-round h-5rem"
                    :src="getImagePath(viewEggProduction.livestockTypeId)"
                    :alt="getLivestockType(viewEggProduction.livestockTypeId)"
                />
            </div>
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="dateOfProduction"
                        v-model="viewEggProduction.dateOfProduction"
                        class="w-full"
                        placeholder="Select Production Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockId"
                        v-model="viewEggProduction.livestockId"
                        :options="livestockChickenOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputNumber
                        v-model="viewEggProduction.eggProduced"
                        placeholder="Eggs Produced"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="viewEggProduction.additionalEggProdNotes"
                        placeholder="Additional Egg Production Notes"
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
                    @click="viewEggProductionDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="saveEditLivestock(viewLivestock)"
                ></Button>
            </div>
        </Dialog>
        <DataView
            :value="livestockEggProductions"
        >
            <template #header>
                <div class="flex justify-content-between">
                    <div class="text-3xl font-semibold">Egg Productions</div>
                    <Button label="New" @click="newEggProductionDialog = true" />
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
                                    <div class="w-full">
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
                                        @click="viewEggProductionDetails(item.id)"
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

export default {
    data() {
        return {
            viewEggProductionDialog: false,
            newEggProductionDialog: false,
            eggProduction: {
                livestockId: "",
                eggProduced: null,
                additionalEggProdNotes: "",
                dateOfProduction: "",
            },
            viewEggProduction: {
                id: "",
                livestockId: "",
                livestockTypeId: "",
                livestockAgeClassId: "",
                eggProduced: null,
                additionalEggProdNotes: "",
                dateOfProduction: "",
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
            livestocks: [
                {
                    id: "4",
                    livestockTagId: "CHK-101",
                    livestockTypeId: "1",
                    livestockAgeClassId: "5",
                },
                {
                    id: "5",
                    livestockTagId: "CHK-102",
                    livestockTypeId: "1",
                    livestockAgeClassId: "5",
                },
                {
                    id: "6",
                    livestockTagId: "CHK-103",
                    livestockTypeId: "1",
                    livestockAgeClassId: "5",
                },
            ],
            livestockEggProductions: [
                {
                    id: "1",
                    livestockId: "4",
                    livestockTagId: "CHK-101",
                    livestockTypeId: "1",
                    livestockAgeClassId: "5",
                    eggProduced: 20,
                    additionalEggProdNotes: "",
                    dateOfProduction: "2024-02-01",
                },
                {
                    id: "2",
                    livestockId: "5",
                    livestockTagId: "CHK-102",
                    livestockTypeId: "1",
                    livestockAgeClassId: "5",
                    eggProduced: 25,
                    additionalEggProdNotes: "",
                    dateOfProduction: "2024-02-08",
                },
            ],
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
            livestockChickenOptions: [],
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
            if (this.livestockTypesOptions) {
                const livestockType = this.livestockTypesOptions.find(
                    (option) => option.code === type
                );
                if (livestockType) {
                    return livestockType.name;
                } else {
                    console.error(`Livestock type not found for code: ${type}`);
                    return "Unknown"; // Return a default value or handle the error accordingly
                }
            } else {
                console.error("Livestock types options not available");
                return "Unknown"; // Return a default value or handle the error accordingly
            }
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
        viewEggProductionDetails(id) {
            console.log(id);
            this.viewEggProduction = this.livestockEggProductions.find(
                (livestock) => livestock.id === id
            );
            this.viewEggProductionDialog = true;
        },
        async saveEditEggProduction(eggProduction) {
            console.log(JSON.stringify(eggProduction));
        },
        async addNewEggProduction(eggProduction) {
            console.log(JSON.stringify(eggProduction));
        },
        generatelivestockOptions() {
            if (this.livestocks) {
                this.livestockChickenOptions = this.livestocks.map(
                    (livestock) => ({
                        name: livestock.livestockTagId,
                        code: livestock.id,
                    })
                );
            }
        },
    },
    created() {
        this.generatelivestockOptions();
    },
};
</script>
