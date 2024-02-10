<template>
    <div class="card">
        <Dialog
            v-model:visible="newLivestockVaccinationDialog"
            modal
            header="New Livestock Vaccination"
            :style="{ width: '22rem' }"
        >
            <div class="mt-3 formgrid grid-nogutter h-25rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="vaccinationDate"
                        v-model="livestockVaccination.vaccinationDate"
                        class="w-full"
                        placeholder="Select Vaccination Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockSex"
                        v-model="livestockVaccination.livestockId"
                        :options="livestockToVaccinate"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="livestockVaccinations.vaccinationName"
                        placeholder="Vaccine name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="livestockVaccination.vaccinationDescription"
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
                    @click="newLivestockVaccinationDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Add Livestock"
                    @click="addNewLivestockVaccination(livestockVaccination)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockVaccinationDialog"
            modal
            header="Vaccination Details"
            :style="{ width: '22rem' }"
        >
            <div>
                <img
                    class="block xl:block mx-auto border-round h-5rem"
                    :src="
                        getImagePath(viewLivestockVaccination.livestockTypeId)
                    "
                    :alt="
                        getLivestockType(
                            viewLivestockVaccination.livestockTypeId
                        )
                    "
                />
            </div>
            <div class="mt-3 formgrid grid-nogutter h-20rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="vaccinationDate"
                        v-model="viewLivestockVaccination.vaccinationDate"
                        class="w-full"
                        placeholder="Select Vaccination Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Dropdown
                        inputId="livestockSex"
                        v-model="viewLivestockVaccination.livestockId"
                        :options="livestockToVaccinate"
                        optionValue="code"
                        optionLabel="name"
                        class="w-full"
                        placeholder="Select Livestock"
                    ></Dropdown>
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <InputText
                        v-model="viewLivestockVaccination.vaccinationName"
                        placeholder="Vaccine name"
                        class="w-full"
                    />
                </div>
                <div class="field col-12 flex align-items-center gap-2">
                    <Textarea
                        v-model="viewLivestockVaccination.vaccinationDescription"
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
                    @click="viewLivestockVaccinationDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="
                        saveEditLivestockVaccination(viewLivestockVaccination)
                    "
                ></Button>
            </div>
        </Dialog>
        <DataView :value="livestockVaccinations">
            <template #header>
                <div class="flex justify-content-between">
                    <div class="text-3xl font-semibold">Vaccinations</div>
                    <Button
                        label="New"
                        @click="newLivestockVaccinationDialog = true"
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
                                                {{ item.vaccinationDate }}
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
                                        @click="
                                            viewLivestockVaccinationDetails(
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
            viewLivestockVaccinationDialog: false,
            newLivestockVaccinationDialog: false,
            livestockVaccination: {
                livestockId: "",
                vaccinationName: "",
                vaccinationDescription: "",
                vaccinationDate: "",
            },
            viewLivestockVaccination: {
                id: "",
                livestockId: "",
                livestockTagId: "",
                livestockTypeId: "",
                vaccinationName: "",
                vaccinationDescription: "",
                vaccinationDate: "",
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
            livestockVaccinations: [
                {
                    id: "1",
                    livestockId: "1",
                    livestockTagId: "CTL-101",
                    livestockTypeId: "3",
                    vaccinationName: "Clostridium novyi",
                    vaccinationDescription:
                        "Guards against black disease, another clostridial infection",
                    vaccinationDate: "2024-1-31",
                },
                {
                    id: "2",
                    livestockId: "1",
                    livestockTagId: "CTL-101",
                    livestockTypeId: "3",
                    vaccinationName: "Bovine Coronavirus",
                    vaccinationDescription:
                        "Guards against respiratory and enteric diseases",
                    vaccinationDate: "2024-2-1",
                },
                {
                    id: "3",
                    livestockId: "2",
                    livestockTagId: "PG-101",
                    livestockTypeId: "2",
                    vaccinationName: "Porcine Circovirus Type 2 (PCV2) Vaccine",
                    vaccinationDescription:
                        "Protects against Porcine Circovirus Type 2",
                    vaccinationDate: "2024-2-1",
                },
                {
                    id: "4",
                    livestockId: "3",
                    livestockTagId: "PG-102",
                    livestockTypeId: "2",
                    vaccinationName: "Porcine Circovirus Type 2 (PCV2) Vaccine",
                    vaccinationDescription:
                        "Protects against Porcine Circovirus Type 2",
                    vaccinationDate: "2024-2-1",
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
            livestockToVaccinate: [],
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
        viewLivestockVaccinationDetails(id) {
            this.viewLivestockVaccination = this.livestockVaccinations.find(
                (vaccination) => vaccination.id === id
            );
            this.viewLivestockVaccinationDialog = true;
        },
        async saveEditLivestockVaccination(livestockVaccination) {
            console.log(JSON.stringify(livestockVaccination));
        },
        async addNewLivestockVaccination(livestockVaccination) {
            console.log(JSON.stringify(livestockVaccination));
        },
        generatelivestockVaccinateOptions() {
            if (this.livestocks) {
                this.livestockToVaccinate = this.livestocks.map(
                    (livestock) => ({
                        name: livestock.livestockTagId,
                        code: livestock.id,
                    })
                );
            }
        },
    },
    watch: {
        "livestock.livestockTypeId"(newVal, oldVal) {
            this.livestockBreedsOptions = this.livestockBreeds[newVal.code];
            this.livestockAgeClassesOptions =
                this.livestockAgeClasses[newVal.code];
        },
    },
    created() {
        this.generatelivestockVaccinateOptions();
    },
};
</script>
