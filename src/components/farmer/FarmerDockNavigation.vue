<template>
    <div class="min-w-screen">
        <Dock
            :model="items"
            :position="position"
            :pt="{
                menuitem: {
                    style: {
                        padding: '0.1rem',  
                    },
                },
            }"
        >
            <template #icon="{ item }">
                <router-link
                    v-tooltip.top="item.label"
                    :to="{ name: item.path }"
                >
                    <img
                        :alt="item.label"
                        :src="item.icon"
                        style="width: 100%"
                    />
                </router-link>
            </template>
        </Dock>
    </div>
</template>

<script>
import Divider from 'primevue/divider';

export default {
    data() {
        return {
            items: [
                {
                    label: "Home",
                    icon: "/src/assets/icons/dock-icons/home-48.png",
                    path: "FarmerDashboard",
                },
                {
                    label: "Livestock",
                    icon: "/src/assets/icons/dock-icons/pig-food-48.png",
                    path: "FarmerLivestock",
                },
                {
                    label: "History",
                    icon: "/src/assets/icons/dock-icons/history-48.png",
                    path: "FarmerHistory",
                },
                {
                    label: "Notification",
                    icon: "/src/assets/icons/dock-icons/notification-48.png",
                    path: "FarmerNotification",
                },
                {
                    label: "Profile",
                    icon: "/src/assets/icons/dock-icons/male-user-48.png",
                    path: "FarmerProfile",
                },
            ],
            position: "bottom",
        };
    },
};
</script>
