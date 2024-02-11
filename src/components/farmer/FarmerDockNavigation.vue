<template>
    <div class="farmer-dock-nav">
        <Dock
            :model="items"
            :position="position"
            :pt="{
                container:{
                    style: { backgroundColor:'#396C7B42', backdropFilter: 'blur(10px)' },
                },
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
export default {
    data() {
        return {
            items: [
                {
                    label: "Home",
                    icon: "/icons/dock-icons/home-48.png",
                    path: "FarmerDashboard",
                },
                {
                    label: "Livestock",
                    icon: "/icons/dock-icons/pig-food-48.png",
                    path: "FarmerLivestock",
                },
                {
                    label: "History",
                    icon: "/icons/dock-icons/history-48.png",
                    path: "FarmerHistory",
                },
                {
                    label: "Notification",
                    icon: "/icons/dock-icons/notification-48.png",
                    path: "FarmerNotification",
                },
                {
                    label: "Profile",
                    icon: "/icons/dock-icons/male-user-48.png",
                    path: "FarmerProfile",
                },
            ],
            position: "bottom",
        };
    },
};
</script>
