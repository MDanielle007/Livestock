<template>
    <div class="card overflow-y-auto" style="min-height: 536px">
        <Dialog
            v-model:visible="viewfarmerHistoryDetailsDialog"
            modal
            :style="{ width: '22rem' }"
        >
            <template #container="{ closeCallback }">
                <div
                    class="bg-white flex flex-column px-5 py-5 gap-4 border-round-lg"
                >
                    <div class="flex justify-content-between align-items-end">
                        <img
                            class="block xl:block border-round h-5rem"
                            :src="
                                getImagePath(viewfarmerHistoryDetails.entityAffected)
                            "
                            :alt="viewfarmerHistoryDetails.entityAffected"
                        />
                        <div class="text-lg font-semibold text-700 mb-1">
                            {{
                                formatDateTime(
                                    viewfarmerHistoryDetails.timestamp
                                )
                            }}
                        </div>
                    </div>
                    <div class="flex flex-column h-15rem overflow-y-auto gap-3">
                        <div class="border-bottom-2 text-2xl font-bold pb-1">
                            {{ viewfarmerHistoryDetails.title }}
                        </div>
                        <div>
                            {{ viewfarmerHistoryDetails.description }}
                        </div>
                    </div>
                    <div
                        class="flex align-items-center gap-3 justify-content-end"
                    >
                        <Button
                            type="button"
                            label="Cancel"
                            severity="secondary"
                            @click="closeCallback"
                        ></Button>
                    </div>
                </div>
            </template>
        </Dialog>
        <DataView :value="farmerHistory">
            <template #list="slotProps">
                <div class="grid grid-nogutter">
                    <div
                        v-for="(item, index) in slotProps.items"
                        :key="index"
                        class="col-12"
                    >
                        <div
                            class="flex sm:align-items-center px-3 py-2 gap-3"
                            :class="{
                                'border-top-2 surface-border': index !== 0,
                            }"
                            @click="viewHistory(item.id)"
                        >
                            <div class="w-4rem relative">
                                <img
                                    class="block xl:block mx-auto border-round w-full"
                                    :src="getImagePath(item.entityAffected)"
                                    :alt="item.entityAffected"
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
                                            class="flex flex-column justify-content-between"
                                        >
                                            <div
                                                class="text-lg"
                                            >
                                                {{ item.title }}
                                            </div>
                                            <div
                                                class="text-md"
                                            >
                                                {{ item.description }}
                                            </div>
                                            <div
                                                class="text-sm"
                                            >
                                                {{
                                                    formatDateTime(
                                                        item.timestamp
                                                    )
                                                }}
                                            </div>
                                        </div>
                                    </div>
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
import {formatDateTime} from '@/utils/StringFormatters';

export default {
    data() {
        return {
            viewfarmerHistoryDetailsDialog: false,
            viewfarmerHistoryDetails: {
                id: "",
                livestockId: "",
                action: "",
                title: "",
                description: "",
                entityAffected: "",
                timestamp: "",
            },
            farmerHistory: [
                {
                    id: "1",
                    livestockId: "1",
                    action: "Create",
                    title: "Add New Livestock",
                    description: "Add New Livestock Cattle, CTL-101",
                    entityAffected: "Livestock",
                    timestamp: "2024-2-6 14:32:12",
                },
                {
                    id: "2",
                    livestockId: "2",
                    action: "Create",
                    title: "Add New Livestock",
                    description: "Add New Livestock Pig, PG-101",
                    entityAffected: "Livestock",
                    timestamp: "2024-2-9 07:42:53",
                },
                {
                    id: "3",
                    livestockId: "3",
                    action: "Create",
                    title: "Add New Livestock",
                    description: "Add New Livestock Pig, PG-102",
                    entityAffected: "Livestock",
                    timestamp: "2024-02-21 17:33:11",
                },
            ],
        };
    },
    methods: {
        formatDateTime,
        getImagePath(entity) {
            switch (entity) {
                case "Livestock":
                    return "/icons/history-icons/cow-96.png";
                case "Vaccination":
                    return "/icons/history-icons/vaccine-96.png";
                case "Breeding":
                    return "/icons/history-icons/heart-96.png";
                case "Mortality":
                    return "/icons/history-icons/dead-chicken-96.png";
            }
        },
        viewHistory(id) {
            this.viewfarmerHistoryDetails = this.farmerHistory.find(
                (livestock) => livestock.id === id
            );
            this.viewfarmerHistoryDetailsDialog = true;
        },
        sortHistoryByDate() {
            this.farmerHistory.sort((a, b) => {
                return new Date(b.timestamp) - new Date(a.timestamp);
            });
        },
    },
    created() {
        this.sortHistoryByDate();
    },
};
</script>
