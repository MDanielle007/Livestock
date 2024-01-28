<template>
    <div class="bg-red-300">
        <div class="flex flex-column max-h-screen w-19rem p-2">
            <div
                class="flex align-items-center justify-content-between px-4 h-5rem flex-shrink-0"
            >
                <span class="inline-flex align-items-center gap-2">
                    <svg
                        width="35"
                        height="40"
                        viewBox="0 0 35 40"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="..." fill="var(--primary-color-color)" />
                        <path d="..." fill="var(--text-color)" />
                    </svg>
                    <span class="font-semibold text-2xl text-primary"
                        >Your Logo</span
                    >
                </span>
            </div>
            <div class="h-30rem overflow-y-auto">
                <ul class="list-none p-0 m-0 overflow-hidden">
                    <li>
                        <router-link
                            class="no-underline"
                            :to="{ name: 'AdminDashboard' }"
                        >
                            <a
                                v-ripple
                                class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                            >
                                <i class="pi pi-home mr-2"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
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
                            <i class="pi pi-chevron-down ml-auto"></i>
                        </a>
                        <ul
                            class="list-none py-0 pl-3 pr-0 m-0 hidden overflow-y-hidden transition-all transition-duration-400 transition-ease-in-out"
                        >
                            <li>
                                <router-link
                                    class="no-underline"
                                    :to="{ name: 'AdminLivestockMonitoring' }"
                                >
                                    <a
                                        v-ripple
                                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-chart-line mr-2"></i>
                                        <span class="font-medium"
                                            >Livestock Monitoring</span
                                        >
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    class="no-underline"
                                    :to="{
                                        name: 'AdminLivestockVaccinationMonitoring',
                                    }"
                                >
                                    <a
                                        v-ripple
                                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-chart-line mr-2"></i>
                                        <span class="font-medium"
                                            >Vaccination Monitoring</span
                                        >
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    class="no-underline"
                                    :to="{
                                        name: 'AdminLivestockBreedingMonitoring',
                                    }"
                                >
                                    <a
                                        v-ripple
                                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-chart-line mr-2"></i>
                                        <span class="font-medium"
                                            >Breeding Monitoring</span
                                        >
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    class="no-underline"
                                    :to="{
                                        name: 'AdminLivestockMortalityMonitoring',
                                    }"
                                >
                                    <a
                                        v-ripple
                                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                                    >
                                        <i class="pi pi-chart-line mr-2"></i>
                                        <span class="font-medium"
                                            >Mortality Monitoring</span
                                        >
                                    </a>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <router-link
                            class="no-underline"
                            :to="{ name: 'AdminReportAnalysis' }"
                        >
                            <a
                                v-ripple
                                class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                            >
                                <i class="pi pi-users mr-2"></i>
                                <span class="font-medium"
                                    >Report and Analysis</span
                                >
                            </a>
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            class="no-underline"
                            :to="{ name: 'AdminAuditTrail' }"
                        >
                            <a
                                v-ripple
                                class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                            >
                                <i class="pi pi-comments mr-2"></i>
                                <span class="font-medium">Audit Trail</span>
                            </a>
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            class="no-underline"
                            :to="{ name: 'AdminLivestockAdvisories' }"
                        >
                            <a
                                v-ripple
                                class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                            >
                                <i class="pi pi-calendar mr-2"></i>
                                <span class="font-medium"
                                    >Livestock Advisories</span
                                >
                            </a>
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            class="no-underline"
                            :to="{ name: 'AdminUserManagement' }"
                        >
                            <a
                                v-ripple
                                class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                            >
                                <i class="pi pi-calendar mr-2"></i>
                                <span class="font-medium">User Management</span>
                            </a>
                        </router-link>
                    </li>

                    <li>
                        <router-link
                            class="no-underline"
                            :to="{ name: 'AdminSettings' }"
                        >
                            <a
                                v-ripple
                                class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                            >
                                <i class="pi pi-cog mr-2"></i>
                                <span class="font-medium">Settings</span>
                            </a>
                        </router-link>
                    </li>
                </ul>
            </div>
            <div>
                <hr class="mb-3 mx-3 border-top-1 border-none surface-border" />
                <router-link
                    class="no-underline"
                    :to="{ name: 'AdminProfile' }"
                >
                    <a
                        v-ripple
                        class="m-3 flex align-items-center cursor-pointer p-3 gap-2 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                    >
                        <Avatar
                            image="/images/avatar/amyelsner.png"
                            shape="circle"
                        />
                        <span class="font-bold">Amy Elsner</span>
                    </a>
                </router-link>
                <a
                    v-ripple
                    class="m-3 flex align-items-center cursor-pointer p-3 gap-2 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple"
                >
                    <i class="pi pi-cog mr-2"></i>
                    <span class="font-medium">Log Out</span>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {};
</script>
<style></style>
