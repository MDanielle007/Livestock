<template>
    <div class="card">
        <Dialog
            v-model:visible="editPregnancyDialog"
            modal
            header="Update Livestock Pregnancy Status"
            :style="{ width: '50vw' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
        >
            <div class="mt-3 formgrid grid-nogutter overflow-y-auto">
                <div class="field col-12 flex flex-column gap-1">
                    <small class="font-semibold">Livestock Pregnancy Status</small>
                    <Dropdown
                        v-model="viewLivestockPregnancy.outcome"
                        :options="outcomeOptions"
                        optionValue="code"
                        optionLabel="name"
                        placeholder="Select a outcome"
                        class="w-full md:w-14rem"
                    />
                </div>
                <div
                    v-if="successfulPregnancy"
                    class="field col-12 flex flex-column gap-1"
                >
                    <small class="font-semibold">Actual Livestock Delivery Date</small>
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
                    class="field col-12 flex flex-column gap-1"
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
                    class="field col-12 flex flex-column gap-1"
                >
                    <small class="font-semibold">Female OffSprings</small>
                    <InputNumber
                        v-model="successfulPregnancyDetails.femaleOffsprings"
                        inputId="femaleOffsprings"
                        placeholder="Number of Female Offsprings"
                    />
                </div>
            </div>
            <div
                class="flex justify-content-end gap-2 border-top-1 border-300 p-2"
            >
                <Button
                    type="button"
                    label="Close"
                    severity="secondary"
                    @click="editPregnancyDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="editPregnancyDialog = true"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="viewLivestockPregnancyDialog"
            modal
            header="Livestock Pregnancy Details"
            :style="{ width: '22rem' }"
        >
            <div class="flex flex-column justify-content-center">
                <div
                    class="flex flex-column justify-content-center text-center h-18rem gap-3"
                >
                    <div>
                        <img
                            class="block xl:block mx-auto border-round h-5rem"
                            :src="
                                getImagePath(
                                    viewLivestockPregnancy.livestockTypeId
                                )
                            "
                            :alt="
                                getLivestockType(
                                    viewLivestockPregnancy.livestockTypeId
                                )
                            "
                        />
                        <div class="text-xl font-bold text-700">
                            {{ viewLivestockPregnancy.livestockTagId }}
                        </div>
                        <div
                            class="text-xl font-bold"
                            :class="
                                getLivestockPregnancyOutcome(
                                    viewLivestockPregnancy.outcome
                                )
                            "
                        >
                            {{ viewLivestockPregnancy.outcome }}
                        </div>
                    </div>
                    <div
                        class="flex flex-column justify-content-between text-left gap-3"
                    >
                        <div class="">
                            <small>Pregnancy Start Date</small>
                            <div>
                                {{ viewLivestockPregnancy.pregnancyStartDate }}
                            </div>
                        </div>
                        <div>
                            <small>Pregnancy Expected End Date</small>
                            <div>
                                {{ viewLivestockPregnancy.pregnancyStartDate }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-content-end gap-2 border-top-1 p-2">
                <Button
                    type="button"
                    label="Close"
                    severity="secondary"
                    @click="viewLivestockPregnancyDialog = false"
                ></Button>
                <Button
                    type="button"
                    label="Edit Pregnancy"
                    @click="editPregnancyDialog = true"
                ></Button>
            </div>
        </Dialog>
        <DataView :value="livestockPregnancies">
            <template #header>
                <div class="flex justify-content-between">
                    <div class="text-2xl font-semibold">
                        Pregnant Livestocks
                    </div>
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
                                    <div class="w-full flex flex-column gap-1">
                                        <div class="flex justify-content-end">
                                            <div
                                                class="font-medium text-secondary text-sm"
                                            >
                                                {{ item.pregnancyStartDate }}
                                            </div>
                                        </div>
                                        <div class="text-xl font-bold text-900">
                                            {{ item.outcome }}
                                        </div>

                                        <div
                                            class="flex justify-content-between"
                                        >
                                            <div class="font-semibold text-sm">
                                                {{ item.livestockTagId }}
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
                                            viewLivestockPregnancyDetails(
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
            editPregnancyDialog: false,
            viewLivestockPregnancyDialog: false,
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
            },
            successfulPregnancyDetails: {
                maleOffsprings: 0,
                femaleOffsprings: 0,
            },
            successfulPregnancy: false,
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
                {
                    name: "Carabao",
                    code: "4",
                },
            ],
            livestockPregnancies: [
                {
                    id: "1",
                    breedingId: "7",
                    livestockId: "6",
                    livestockTagId: "CRB-102",
                    livestockTypeId: "4",
                    outcome: "Pending",
                    pregnancyStartDate: "2024-02-24",
                    expectedDeliveryDate: null,
                    actualDeliveryDate: "2024-02-24",
                },
                {
                    id: "2",
                    breedingId: "8",
                    livestockId: "6",
                    livestockTagId: "CRB-102",
                    livestockTypeId: "4",
                    outcome: "Pending",
                    pregnancyStartDate: "2024-02-24",
                    expectedDeliveryDate: null,
                    actualDeliveryDate: "2024-02-24",
                },
            ],
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
        viewLivestockPregnancyDetails(id) {
            this.viewLivestockPregnancy = this.livestockPregnancies.find(
                (pregnancy) => pregnancy.id === id
            );
            this.viewLivestockPregnancyDialog = true;
        },
        async saveEditLivestockBreeding() {
            this.viewLivestockBreedingDialog = false;
        },
        getLivestockPregnancyOutcome($outcome) {
            switch ($outcome) {
                case "Successful":
                    return "text-green-400";
                case "Pending":
                    return "text-yellow-400";
                case "Miscarriage":
                    return "text-red-400";
                default:
                    return "Unknown";
            }
        },
    },
    watch: {
        "viewLivestockPregnancy.outcome"(newVal, oldVal) {
            if (newVal === "Successful") {
                this.successfulPregnancy = true;
            }
            console.log(newVal);
            console.log(this.successfulPregnancy);
        },
    },
};
</script>
