<template>
    <div class="card overflow-y-auto" style="min-height: 536px;">
        <Dialog
            v-model:visible="viewNotificationDetailsDialog"
            modal
            :style="{ width: '22rem' }"
        >
            <template #container="{ closeCallback }">
                <div class="bg-white flex flex-column px-5 py-5 gap-4 border-round-lg">
                    <div class="flex justify-content-between align-items-end">
                        <img
                            class="block xl:block border-round h-5rem"
                            :src="
                                getImagePath(viewNotificationDetails.isGeneral)
                            "
                            alt="Farmer Notification"
                        />
                        <div class="text-lg font-semibold text-700 mb-1">
                            {{ formatDateTime(viewNotificationDetails.datePublished)  }}
                        </div>
                    </div>
                    <div
                        class="flex flex-column h-15rem overflow-y-auto gap-3"
                    >
                        <div class="border-bottom-2 text-2xl font-bold pb-1">
                            {{ viewNotificationDetails.subject }}
                        </div>
                        <div>
                            {{ viewNotificationDetails.content }}
                        </div>
                    </div>
                    <div class="flex align-items-center gap-3 justify-content-end">
                        <Button
                            type="button"
                            label="Cancel"
                            severity="secondary"
                            @click="closeCallback"
                        ></Button>
                        <Button
                            type="button"
                            label="Mark as Read"
                            severity="success"
                            @click="closeCallback"
                        ></Button>
                    </div>
                </div>
            </template>
        </Dialog>
        <DataView :value="farmerNotifications">
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
                            @click="viewNotification(item.id)"
                        >
                            <div class="w-4rem relative">
                                <img
                                    class="block xl:block mx-auto border-round w-full"
                                    :src="getImagePath(item.isGeneral)"
                                    alt="Farmer Notification"
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
                                                :class="{
                                                    'font-bold':
                                                        item.isRead === 'false',
                                                    'font-medium':
                                                        item.isRead === 'true',
                                                }"
                                            >
                                                {{ item.subject }}
                                            </div>
                                            <div
                                                class="text-md"
                                                :class="{
                                                    'font-bold':
                                                        item.isRead === 'false',
                                                    'font-medium':
                                                        item.isRead === 'true',
                                                }"
                                            >
                                                {{ item.content }}
                                            </div>
                                            <div
                                                class="text-sm"
                                                :class="{
                                                    'font-bold':
                                                        item.isRead === 'false',
                                                    'font-medium':
                                                        item.isRead === 'true',
                                                }"
                                            >
                                                {{
                                                    formatDateTime(
                                                        item.datePublished
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
export default {
    data() {
        return {
            viewNotificationDetailsDialog: false,
            viewNotificationDetails: {
                id: "",
                subject: "",
                content: "",
                isGeneral: "true",
                datePublished: "",
                isRead: "",
            },
            farmerNotifications: [
                {
                    id: "1",
                    subject: "Notification Subject 1",
                    content: "Notification Content 1",
                    isGeneral: "true",
                    datePublished: "2024-01-31 10:23:21",
                    isRead: "true",
                },
                {
                    id: "2",
                    subject: "Notification Subject 2",
                    content: "Notification Content 2",
                    isGeneral: "false",
                    datePublished: "2024-02-05 8:09:23",
                    isRead: "false",
                },
                {
                    id: "3",
                    subject: "Notification Subject 3",
                    content: "Notification Content 3",
                    isGeneral: "true",
                    datePublished: "2024-02-10 05:13:12",
                    isRead: "true",
                },
                {
                    id: "4",
                    subject: "Notification Subject 1",
                    content: "Notification Content 1",
                    isGeneral: "true",
                    datePublished: "2024-01-31 10:23:21",
                    isRead: "true",
                },
                {
                    id: "5",
                    subject: "Notification Subject 2",
                    content: "Notification Content 2",
                    isGeneral: "false",
                    datePublished: "2024-02-05 8:09:23",
                    isRead: "false",
                },
                {
                    id: "6",
                    subject: "Notification Subject 3",
                    content: "Notification Content 3",
                    isGeneral: "true",
                    datePublished: "2024-02-10 05:13:12",
                    isRead: "true",
                },
                {
                    id: "7",
                    subject: "Notification Subject 1",
                    content: "Notification Content 1",
                    isGeneral: "true",
                    datePublished: "2024-01-31 10:23:21",
                    isRead: "true",
                },
                {
                    id: "8",
                    subject: "Notification Subject 2",
                    content: "Notification Content 2",
                    isGeneral: "false",
                    datePublished: "2024-02-05 8:09:23",
                    isRead: "false",
                },
                {
                    id: "9",
                    subject: "Notification Subject 3",
                    content: "Notification Content 3",
                    isGeneral: "true",
                    datePublished: "2024-02-10 05:13:12",
                    isRead: "true",
                },
            ],
        };
    },
    methods: {
        getImagePath(type) {
            switch (type) {
                case "true":
                    return "/src/assets/icons/user-icons/earth-planet-96.png";
                case "false":
                    return "/src/assets/icons/user-icons/farmer-96.png";
            }
        },
        viewNotification(id) {
            console.log(id);
            this.viewNotificationDetails = this.farmerNotifications.find(
                (livestock) => livestock.id === id
            );
            this.viewNotificationDetailsDialog = true;
        },
        formatDateTime(datetimeStr) {
            const dateTime = new Date(datetimeStr);
            const now = new Date();
            const diffInMs = now - dateTime;
            const diffInSec = Math.floor(diffInMs / 1000);
            const diffInMin = Math.floor(diffInSec / 60);
            const diffInHour = Math.floor(diffInMin / 60);
            const diffInDay = Math.floor(diffInHour / 24);

            if (diffInSec < 60) {
                return "just now";
            } else if (diffInMin < 60) {
                return `${diffInSec} sec ago`;
            } else if (diffInHour < 24) {
                return `${diffInMin} mins ago`;
            } else if (diffInDay === 1) {
                return "Yesterday";
            } else if (diffInDay < 7) {
                return `${diffInDay} days ago`;
            } else {
                // If the time exceeds one week, return the datetime in the format 'yy-mm-dd'
                const year = dateTime.getFullYear().toString().slice(-2);
                const month = ("0" + (dateTime.getMonth() + 1)).slice(-2);
                const day = ("0" + dateTime.getDate()).slice(-2);
                return `${year}-${month}-${day}`;
            }
        },
        sortNotificationsByDate() {
            this.farmerNotifications.sort((a, b) => {
                return new Date(b.datePublished) - new Date(a.datePublished);
            });
        },
    },
    created() {
        this.sortNotificationsByDate();
    },
};
</script>
