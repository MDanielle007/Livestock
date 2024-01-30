<template>
    <div class="flex min-w-full min-h-screen">
        <AdminSidebar :visible="sideBarVisible" />
        <div class="h-screen w-full">
            <AdminAppbar @hideSideBar="hideAdminSideBar" />
            <main class="bg-green-300">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script>
import { RouterView } from "vue-router";
import AdminAppbar from "@/components/admin/AdminAppbar.vue";
import AdminSidebar from "@/components/admin/AdminSidebar.vue";

export default {
    data() {
        return {
            sideBarVisible: true,
        };
    },
    components: {
        RouterView,
        AdminAppbar,
        AdminSidebar,
    },
    methods: {
        hideAdminSideBar() {
            this.sideBarVisible = !this.sideBarVisible;
        },
    },
};
</script>

<style>
.slidedown-enter-active,
.slideup-leave-active {
    transition: margin-left 0.5s;
}

.slidedown-enter,
.slidedown-leave-to,
.slideup-enter,
.slideup-leave-to {
    margin-left: -19rem; /* Adjust this value based on your sidebar width */
}
</style>
