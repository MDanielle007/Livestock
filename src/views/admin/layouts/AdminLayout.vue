<template>
    <div class="flex min-w-full min-h-screen surface-100">
        <div class="layout-sidebar">
            <AdminSidebar :visible="sideBarVisible" />
        </div>
        <Sidebar v-if="overlaySidebar" v-model:visible="overlaySidebar">
            <template #container>
                <div class="flex flex-column max-h-screen w-19rem p-1">
                    <div class="border-round-lg shadow-1">
                        <div
                            class="flex align-items-center justify-content-between px-4 h-5rem flex-shrink-0 mt-2"
                        >
                            <span class="inline-flex align-items-center gap-2">
                                <Image
                                    src="/src/assets/icons/android-chrome-512x512.png"
                                    alt="Image"
                                    width="80"
                                />
                                <span
                                    class="font-semibold text-3xl text-blue-800"
                                    >OrMin Livestock</span
                                >
                            </span>
                        </div>
                        <div class="h-30rem overflow-y-auto p-3">
                            <ul class="list-none p-0 m-0 overflow-hidden">
                                <li>
                                    <router-link
                                        v-ripple
                                        class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                        :to="{ name: 'AdminDashboard' }"
                                    >
                                        <i class="pi pi-home mr-2"></i>
                                        <span class="font-medium"
                                            >Dashboard</span
                                        >
                                    </router-link>
                                </li>
                                <li>
                                    <a
                                        v-ripple
                                        v-styleclass="{
                                            selector: '@next',
                                            enterClass: 'hidden',
                                            enterActiveClass: 'slidedown',
                                            leaveToClass: 'hidden',
                                            leaveActiveClass: 'slideup',
                                        }"
                                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-chart-line mr-2"></i>
                                        <span class="font-medium"
                                            >Livestock Management</span
                                        >
                                        <i
                                            class="pi pi-chevron-down ml-auto"
                                        ></i>
                                    </a>
                                    <ul
                                        class="list-none py-0 pl-3 pr-0 m-0 hidden overflow-y-hidden transition-all transition-duration-400 transition-ease-in-out"
                                    >
                                        <li>
                                            <router-link
                                                v-ripple
                                                class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                                :to="{
                                                    name: 'AdminLivestockMonitoring',
                                                }"
                                            >
                                                <span class="font-medium"
                                                    >Livestock Monitoring</span
                                                >
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                v-ripple
                                                class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                                :to="{
                                                    name: 'AdminLivestockVaccinationMonitoring',
                                                }"
                                            >
                                                <span class="font-medium"
                                                    >Vaccination
                                                    Monitoring</span
                                                >
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                v-ripple
                                                class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                                :to="{
                                                    name: 'AdminLivestockBreedingMonitoring',
                                                }"
                                            >
                                                <span class="font-medium"
                                                    >Breeding Monitoring</span
                                                >
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link
                                                v-ripple
                                                class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                                :to="{
                                                    name: 'AdminLivestockMortalityMonitoring',
                                                }"
                                            >
                                                <span class="font-medium"
                                                    >Mortality Monitoring</span
                                                >
                                            </router-link>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <router-link
                                        v-ripple
                                        class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                        :to="{ name: 'AdminReportAnalysis' }"
                                    >
                                        <i class="pi pi-chart-bar mr-2"></i>
                                        <span class="font-medium"
                                            >Report and Analysis</span
                                        >
                                    </router-link>
                                </li>
                                <li>
                                    <router-link
                                        v-ripple
                                        class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                        :to="{ name: 'AdminAuditTrail' }"
                                    >
                                        <i class="pi pi-book mr-2"></i>
                                        <span class="font-medium"
                                            >Audit Trail</span
                                        >
                                    </router-link>
                                </li>
                                <li>
                                    <router-link
                                        :to="{
                                            name: 'AdminLivestockAdvisories',
                                        }"
                                        v-ripple
                                        class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-whatsapp mr-2"></i>
                                        <span class="font-medium"
                                            >Livestock Advisories</span
                                        >
                                    </router-link>
                                </li>
                                <li>
                                    <router-link
                                        :to="{ name: 'AdminUserManagement' }"
                                        v-ripple
                                        class="no-underline flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-users mr-2"></i>
                                        <span class="font-medium"
                                            >User Management</span
                                        >
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <hr
                                class="mb-3 mx-3 border-top-1 border-none surface-border"
                            />
                            <ul class="list-none p-0 m-0 overflow-hidden p-3">
                                <li>
                                    <router-link
                                        :to="{ name: 'AdminProfile' }"
                                        v-ripple
                                        class="no-underline flex align-items-center cursor-pointer px-3 py-2 gap-2 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-user mr-2"></i>
                                        <span class="font-bold">Profile</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link
                                        :to="{ name: 'AdminSettings' }"
                                        v-ripple
                                        class="no-underline flex align-items-center cursor-pointer px-3 py-2 gap-2 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-cog mr-2"></i>
                                        <span class="font-medium"
                                            >Settings</span
                                        >
                                    </router-link>
                                </li>
                                <li>
                                    <div>
                                        <Button
                                            label="Log Out"
                                            text
                                            icon="pi pi-sign-out"
                                            class="text-700 mr-2 w-full text-left"
                                            @click="userLogout"
                                        ></Button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>
        </Sidebar>
        <div class="h-screen w-full">
            <AdminAppbar @hideSideBar="hideAdminSideBar" />
            <main class="p-2 overflow-y-auto h-30rem content-container">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script>
import { RouterView } from "vue-router";
import AdminAppbar from "@/components/admin/AdminAppbar.vue";
import AdminSidebar from "@/components/admin/AdminSidebar.vue";
import { getCookie, clearToken } from "@/utils/CookieUtils";
import { jwtDecode as jwt_decode } from 'jwt-decode';
import axios from "axios";

export default {
    data() {
        return {
            sideBarVisible: true,
            overlaySidebar: false,
            screenWidth: window.innerWidth,
        };
    },
    components: {
        RouterView,
        AdminAppbar,
        AdminSidebar,
    },
    created() {
        // Call method on component creation
        this.checkScreenWidth();

        // Add event listener for window resize
        window.addEventListener("resize", this.checkScreenWidth);
    },
    destroyed() {
        // Remove event listener when component is destroyed
        window.removeEventListener("resize", this.checkScreenWidth);
    },
    methods: {
        hideAdminSideBar() {
            this.sideBarVisible = !this.sideBarVisible;

            if (this.screenWidth <= 1024) {
                this.overlaySidebar = true;
            }
        },
        checkScreenWidth() {
            // Update screenWidth data property
            this.screenWidth = window.innerWidth;

            // Update foo based on screen width
            this.overlaySidebar = this.screenWidth <= 1024;
        },
        async userLogout() {
            const token = getCookie("token");

            const decodedToken = jwt_decode(token);

            const userid = decodedToken.sub;

            console.log(userid);

            const response = await axios.post("logout", { userId: userid });

            console.log(response);

            clearToken();

            // Redirect to the login page or any desired destination
            this.$router.push("/login");
        },
    },
    watch: {},
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
