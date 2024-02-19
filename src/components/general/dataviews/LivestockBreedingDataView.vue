<template>
    <div class="card">
        <Dialog
            v-model:visible="newLivestockBreedingDialog"
            modal
            header="New Livestock Breeding"
            :style="{ width: '22rem' }"
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
                    label="Save"
                    @click="addNewLivestockBreeding(livestockBreeding)"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockBreedingDialog"
            modal
            header="Vaccination Details"
            :style="{ width: '22rem' }"
        >
            <div>
                <img
                    class="block xl:block mx-auto border-round h-5rem"
                    :src="getImagePath(viewLivestockBreeding.livestockTypeId)"
                    :alt="
                        getLivestockType(viewLivestockBreeding.livestockTypeId)
                    "
                />
            </div>
            <div class="mt-3 formgrid grid-nogutter h-20rem overflow-y-auto">
                <div class="field col-12 flex align-items-center gap-2">
                    <Calendar
                        inputId="breedDate"
                        v-model="viewLivestockBreeding.breedDate"
                        class="w-full"
                        placeholder="Select Vaccination Date"
                        dateFormat="yy-mm-dd"
                        showIcon
                    />
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
                        :options="generateLivestockOptions(viewLivestockBreeding.livestockTypeId, 'Male')"
                        optionValue="code"
                        optionLabel="name"
                        class="flex-1"
                        placeholder="Male"
                    ></Dropdown>
                    <Dropdown
                        inputId="femaleLivestockTagId"
                        v-model="viewLivestockBreeding.femaleLivestockTagId"
                        :options="generateLivestockOptions(viewLivestockBreeding.livestockTypeId, 'Female')"
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
        <DataView :value="livestockBreedings">
            <template #header>
                <div class="flex justify-content-between">
                    <div class="text-3xl font-semibold">Breedings</div>
                    <Button
                        label="New"
                        @click="newLivestockBreedingDialog = true"
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
                            class="flex sm:align-items-center p-2 gap-3"
                            :class="{
                                'border-top-1 surface-border': index !== 0,
                            }"
                        >
                            <div class="w-5rem relative">
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
                                    <div class="w-full flex flex-column gap-2">
                                        <div class="flex justify-content-end">
                                            <div
                                                class="font-medium text-secondary text-sm"
                                            >
                                                {{ item.breedDate }}
                                            </div>
                                        </div>
                                        <div class="text-md font-bold text-900">
                                            {{ item.breedResult }}
                                        </div>

                                        <div
                                            class="flex justify-content-between"
                                        >
                                            <div class="font-semibold text-sm">
                                                {{ item.maleLivestockTagId }}
                                            </div>
                                            <div class="font-semibold text-sm">
                                                {{ item.femaleLivestockTagId }}
                                            </div>
                                        </div>
                                    </div>
                                    <Button
                                        icon="pi pi-pencil"
                                        label="View Info"
                                        severity="secondary"
                                        class="w-full"
                                        outlined
                                        @click="
                                            viewLivestockBreedingDetails(
                                                item.id
                                            )
                                        "
                                    />
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex justify-content-between w-full px-2"
                        ></div>
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
            viewLivestockBreedingDialog: false,
            newLivestockBreedingDialog: false,
            livestockBreeding: {
                livestockTypeId: "",
                maleLivestockTagId: "",
                femaleLivestockTagId: "",
                breedResult: "",
                breedAdditionalNotes: "",
                breedDate: "",
            },
            viewLivestockBreeding: {
                id: "",
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
            livestockBreedings: [
                {
                    id: "1",
                    livestockTypeId: "2",
                    maleLivestockTagId: "PG-101",
                    femaleLivestockTagId: "PG-102",
                    breedResult: "Successful Pregnancy",
                    breedAdditionalNotes:
                        "Overall, breeding event deemed successful, with high hopes for a healthy and productive outcome",
                    breedDate: "2024-2-6",
                },
            ],
            maleLivestocksOptions: [],
            femaleLivestockOptions: [],
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
            breedingResultsOptions: [
                {
                    name: "Successful Pregnancy",
                    code: "Successful Pregnancy",
                },
                {
                    name: "Failed Pregnancy",
                    code: "Failed Pregnancy",
                },
                {
                    name: "Live Birth",
                    code: "Live Birth",
                },
                {
                    name: "Stillbirth",
                    code: "Stillbirth",
                },
                {
                    name: "Multiple Births",
                    code: "Multiple Births",
                },
                {
                    name: "Single Birth",
                    code: "Single Birth",
                },
                {
                    name: "Fertility Issues",
                    code: "Fertility Issues",
                },
            ]
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
        viewLivestockBreedingDetails(id) {
            this.viewLivestockBreeding = this.livestockBreedings.find(
                (breeding) => breeding.id === id
            );
            this.viewLivestockBreedingDialog = true;
        },
        async saveEditLivestockBreeding(livestockBreeding) {
            console.log(JSON.stringify(livestockBreeding));
            this.viewLivestockBreedingDialog = false;
        },
        async addNewLivestockBreeding(livestockBreeding) {
            console.log(JSON.stringify(livestockBreeding));
            this.newLivestockBreedingDialog = false;
        },
        filterLivestocksBySexAndType(livestockSex, livestockType) {
            return this.livestocks.filter((livestock) => {
                return (
                    livestock.sex === livestockSex &&
                    livestock.livestockTypeId === livestockType
                );
            });
        },
        generateLivestockOptions(livestockTypeId, livestockSex) {
            const livestockOptions = this.livestocks.filter((livestock) => {
                return (
                    livestock.sex === livestockSex &&
                    livestock.livestockTypeId === livestockTypeId
                );
            });

            return livestockOptions.map((livestock) => ({
                name: livestock.livestockTagId,
                code: livestock.livestockTagId,
            }));
        }
    },
    watch: {
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
