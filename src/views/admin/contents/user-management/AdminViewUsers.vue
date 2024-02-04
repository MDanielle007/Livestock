<template>
    <Toolbar class="mb-2 bg-white">
        <template v-slot:start>
            <span class="block p-input-icon-left">
                <i class="pi pi-search" />
                <InputText placeholder="Search..." />
            </span>
        </template>
        <template v-slot:end>
            <div class="my-1">
                <router-link :to="{ name: 'AdminRegisterUser' }">
                    <Button
                        label="New User"
                        icon="pi pi-user-plus"
                        class="p-button-success mr-2"
                    />
                </router-link>
            </div>
        </template>
    </Toolbar>
    <div
        v-if="users"
        class="flex gap-3 flex-wrap px-5 py-3 border-1 border-200 border-round-md"
    >
        <UserCard v-for="user in users" :key="user.id" :user="user" />
    </div>
</template>
<script>
import UserCard from "@/components/admin/UserCard.vue";
export default {
    data() {
        return {
            users: [
                {
                    id: 1,
                    farmerId: "FMR-101",
                    name: "John Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 12,
                        },
                        {
                            livestockType: "Cow",
                            livestockCount: 4,
                        },
                        {
                            livestockType: "Goat",
                            livestockCount: 4,
                        },
                    ],
                },
                {
                    id: 2,
                    farmerId: "FMR-102",
                    name: "Jane Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 15,
                        },
                        {
                            livestockType: "Cow",
                            livestockCount: 9,
                        },
                    ],
                },
                {
                    id: 3,
                    farmerId: "FMR-103",
                    name: "Thomas Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 56,
                        },
                    ],
                },
                {
                    id: 1,
                    farmerId: "FMR-101",
                    name: "John Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 12,
                        },
                        {
                            livestockType: "Cow",
                            livestockCount: 4,
                        },
                        {
                            livestockType: "Goat",
                            livestockCount: 4,
                        },
                    ],
                },
                {
                    id: 2,
                    farmerId: "FMR-102",
                    name: "Jane Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 15,
                        },
                        {
                            livestockType: "Cow",
                            livestockCount: 9,
                        },
                    ],
                },
                {
                    id: 3,
                    farmerId: "FMR-103",
                    name: "Thomas Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 56,
                        },
                    ],
                },
                {
                    id: 1,
                    farmerId: "FMR-101",
                    name: "John Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 12,
                        },
                        {
                            livestockType: "Cow",
                            livestockCount: 4,
                        },
                        {
                            livestockType: "Goat",
                            livestockCount: 4,
                        },
                    ],
                },
                {
                    id: 2,
                    farmerId: "FMR-102",
                    name: "Jane Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 15,
                        },
                        {
                            livestockType: "Cow",
                            livestockCount: 9,
                        },
                    ],
                },
                {
                    id: 3,
                    farmerId: "FMR-103",
                    name: "Thomas Doe",
                    role: "Farmer",
                    image: "https://picsum.photos/200/300",
                    livestocks: [
                        {
                            livestockType: "Chicken",
                            livestockCount: 56,
                        },
                    ],
                },
            ],
        };
    },
    components: {
        UserCard,
    },
};
</script>
<style></style>
