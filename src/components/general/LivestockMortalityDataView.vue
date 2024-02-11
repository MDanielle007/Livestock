<template>
    <div class="card">
        <Dialog
            v-model:visible="newLivestockMortalityDialog"
            modal
            header="Report Livestock Mortality"
            :style="{ width: '22rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="vaccinationDate"
                        v-model="livestockMortality.dateOfDeath"
                        class="w-full"
                        placeholder="Select Vaccination Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockSex"
                        v-model="livestockMortality.livestockId"
                        :options="livestockMortalityOptions"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="livestockMortality.causeOfDeath"
                        placeholder="Vaccine name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="livestockMortality.additionalDeathNotes"
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
                    @click="newLivestockMortalityDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock"
                    @click="addNewLivestockMortalityRecord(livestockMortality)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockMortalityDialog"
            modal
            :header="`Mortality Details for ${viewLivestockMortality.livestockTagId}`"
            :style="{ width: '22rem' }"
        >
            <div>
                <img
                    class="block xl:block mx-auto border-round h-5rem"
                    :src="
                        getImagePath(viewLivestockMortality.livestockTypeId)
                    "
                    :alt="
                        getLivestockType(
                            viewLivestockMortality.livestockTypeId
                        )
                    "
                />
            </div>
            <div class="mt-3 formgrid grid-nogutter h-20rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="vaccinationDate"
                        v-model="viewLivestockMortality.dateOfDeath"
                        class="w-full"
                        placeholder="Select Vaccination Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="viewLivestockMortality.causeOfDeath"
                        placeholder="Livestock Cause of Death"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="
                            viewLivestockMortality.additionalDeathNotes
                        "
                        placeholder="Livestock Mortality Additional Notes"
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
                    @click="viewLivestockMortalityDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="
                        saveEditLivestockMortality(viewLivestockMortality)
                    "
                ></Button>
            </div>
        </Dialog>
        <DataView :value="livestockMortalities">
            <template #header>
                <div class="flex justify-content-between">
                    <div class="text-3xl font-semibold">Vaccinations</div>
                    <Button
                        label="New"
                        @click="newLivestockMortalityDialog = true"
                    />
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
                                    :alt="
                                        getLivestockType(item.livestockTypeId)
                                    "
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
                                                {{ item.dateOfDeath }}
                                            </div>
                                        </div>
                                        <div
                                            class="text-lg font-bold text-900 mt-2"
                                        >
                                            {{ item.causeOfDeath }}
                                        </div>
                                        <div
                                            class="text-md font-semibold text-700"
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
                                        @click="
                                            viewLivestockMortalityDetails(
                                                item.id
                                            )
                                        "
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
            viewLivestockMortalityDialog: false,
            newLivestockMortalityDialog: false,
            livestockMortality: {
                livestockId: "",
                causeOfDeath: "",
                additionalDeathNotes:"",
                dateOfDeath: "",
            },
            viewLivestockMortality: {
                id: "",
                livestockId: "",
                livestockTagId: "",
                livestockTypeId: "",
                causeOfDeath: "",
                additionalDeathNotes:"",
                dateOfDeath: "",
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
            livestockMortalities: [
                {
                    id: "1",
                    livestockId: "4",
                    livestockTagId: "CTL-102",
                    livestockTypeId: "3",
                    causeOfDeath: "Pneumonia",
                    additionalDeathNotes:"",
                    dateOfDeath: "2024-02-7",
                },
                {
                    id: "2",
                    livestockId: "5",
                    livestockTagId: "CHK-101",
                    livestockTypeId: "1",
                    causeOfDeath: "Heatstroke",
                    additionalDeathNotes:"",
                    dateOfDeath: "2024-02-8",
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
                {
                    id: "4",
                    livestockTagId: "CTL-102",
                    livestockTypeId: "3",
                    livestockBreedId: "7",
                    livestockAgeClassId: "12",
                    ageDays: "4 Days",
                    sex: "Male",
                    breedingEligibility: "Not Age-Suited",
                    dateOfBirth: "2024-2-3",
                    livestockHealthStatus: "Dead",
                },
                {
                    id: "5",
                    livestockTagId: "CHK-101",
                    livestockTypeId: "1",
                    livestockBreedId: "1",
                    livestockAgeClassId: "1",
                    ageDays: "5 Days",
                    sex: "Male",
                    breedingEligibility: "Not Age-Suited",
                    dateOfBirth: "2024-2-3",
                    livestockHealthStatus: "Dead",
                },
            ],
            livestockMortalityOptions: [],
        };
    },
    methods: {
        getImagePath(type) {
            switch (type) {
                case "1":
                    return "/src/assets/icons/livestock-icons/chicken-96.png";
                case "2":
                    return "/src/assets/icons/livestock-icons/pig-96.png";
                case "3":
                    return "/src/assets/icons/livestock-icons/cattle-96.png";
                case "4":
                    return "/src/assets/icons/livestock-icons/water-buffalo-96.png";
                case "5":
                    return "/src/assets/icons/livestock-icons/goat-96.png";
                case "6":
                    return "/src/assets/icons/livestock-icons/sheep-96.png";
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
        viewLivestockMortalityDetails(id) {
            this.viewLivestockMortality = this.livestockMortalities.find(
                (vaccination) => vaccination.id === id
            );
            this.viewLivestockMortalityDialog = true;
        },
        async saveEditLivestockMortality(livestockVaccination) {
            console.log(JSON.stringify(livestockVaccination));
        },
        async addNewLivestockMortalityRecord(livestockVaccination) {
            console.log(JSON.stringify(livestockVaccination));
        },
        generatelivestockMortalityOptions() {
            if (this.livestocks) {
                this.livestockMortalityOptions = this.livestocks.map(
                    (livestock) => ({
                        name: livestock.livestockTagId,
                        code: livestock.id,
                    })
                );
            }
        },
    },
    created() {
        this.generatelivestockMortalityOptions();
    },
};
</script>
