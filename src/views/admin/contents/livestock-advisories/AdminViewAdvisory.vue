<template>
    <div>
        <Toolbar class="mb-2 bg-white">
            <template v-slot:start>
                <div class="flex gap-3 align-items-center">
                    <router-link :to="{ name: 'AdminLivestockAdvisories' }">
                        <Button icon="pi pi-chevron-left" />
                    </router-link>
                </div>
            </template>
        </Toolbar>
        <div
            class="flex flex-column gap-3 flex-wrap px-5 py-3 border-1 border-200 border-round-md bg-white h-30rem"
        >
            <div class="text-3xl font-semibold text-700">
                {{ livestockAdvisory.subject }}
            </div>
            <div class="flex gap-1 align-items-end">
                <Avatar
                    :image="getImagePath(livestockAdvisory.advisoryType)"
                    class="mr-2"
                    size="large"
                    shape="circle"
                />
                <div>
                    <div class="font-bold text-700">{{ getAdvisoryType(livestockAdvisory.advisoryType) }}</div>
                    <div class="text-sm">{{ formatDateLong(livestockAdvisory.dataPublished) }}</div>
                </div>
            </div>

            <div>
                {{ livestockAdvisory.content }}
            </div>
        </div>
    </div>
</template>
<script>
import { formatDateLong } from "@/utils/StringFormatters";

export default {
    data() {
        return {
            livestpckAdvisoryId: this.$route.params.id,
            livestockAdvisory: {
                advisoryType: "General",
                subject: "Livestock Advisory 1",
                content:
                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem inventore culpa repellat tempora odio, id saepe ea magni voluptatum nesciunt, ullam unde obcaecati modi possimus ut iste fuga. Pariatur, ratione.",
                dataPublished: "2024-02-10 17:33:11",
            },
        };
    },
    methods: {
        formatDateLong,
        getImagePath(type) {
            switch (type) {
                case "General":
                    return "/icons/user-icons/earth-planet-96.png";
                case "Farmer":
                    return "/icons/user-icons/farmer-96.png";
            }
        },
        getAdvisoryType(type) {
            switch (type) {
                case "General":
                    return "General Advisory";
                case "Farmer":
                    return "Farmer Specific Advisory";
            }
        },
    },
};
</script>
<style></style>
