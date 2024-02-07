<template>
    <Card
        :pt="{
            root: { class: 'p-0 border-round-lg' },
            body: { class: 'p-0' },
            title: { class: 'm-0' },
            subtitle: { class: 'm-0' },
            content: { class: 'p-0' },
        }"
    >
        <template #title>
            <div
                class="bg-yellow-500 text-black-alpha-90 p-2 border-round-top-lg"
            >
                {{ cardTitle }}
            </div>
        </template>
        <template #subtitle>
            <div v-if="cardSubtitle" class="bg-yellow-400 text-white px-2 py-1">
                {{ cardSubtitle }}
            </div>
        </template>
        <template #content>
            <div
                class="bg-red-300 p-3 border-round-bottom-lg flex justify-content-between align-items-center"
                :style="{ height: contentHeight }"
            >
                <div class="font-bold text-3xl">
                    {{ cardContent }}
                </div>
                <div class="bg-blue-300">
                    <img
                        class="h-2rem"
                        alt="user header"
                        :src="getImagePath()"
                    />
                </div>
            </div>
        </template>
    </Card>
</template>

<script>
export default {
    props: {
        cardTitle: String,
        cardSubtitle: String,
        cardContent: Number,
        contentHeight: String,
        contentType: String,
    },
    methods: {
        getImagePath() {

            switch (type) {
                case "Cattle":
                    return require("@/assets/icons/livestock-icons/cattle-96.png");
                case "Chicken":
                    return require("@/assets/icons/livestock-icons/chicken-96.png");
                case "Goat":
                    return require("@/assets/icons/livestock-icons/goat-96.png");
                case "Pig":
                    return require("@/assets/icons/livestock-icons/pig-96.png");
                case "Sheep":
                    return require("@/assets/icons/livestock-icons/sheep-96.png");
                case "Carabao":
                    return require("@/assets/icons/livestock-icons/water-buffalo-96.png");
                default:
                    return ""; // You can provide a default image path if needed
            }
        },
    },
};
</script>
