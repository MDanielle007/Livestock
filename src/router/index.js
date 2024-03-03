import { createRouter, createWebHistory } from "vue-router";

// Auth routes
import LoginPage from "@/views/auth/LoginPage.vue";

// Admin routes
import AdminDashboard from "@/views/admin/contents/AdminDashboard.vue";
import AdminLayout from "@/views/admin/layouts/AdminLayout.vue";
import AdminLivestockAdvisories from "@/views/admin/contents/AdminLivestockAdvisories.vue";
import AdminLivestockMonitoring from "@/views/admin/contents/AdminLivestockMonitoring.vue";
import AdminLivestockVaccinationMonitoring from "@/views/admin/contents/AdminLivestockVaccinationMonitoring.vue";
import AdminLivestockBreedingMonitoring from "@/views/admin/contents/AdminLivestockBreedingMonitoring.vue";
import AdminLivestockMortalityMonitoring from "@/views/admin/contents/AdminLivestockMortalityMonitoring.vue";
import AdminReportAnalysis from "@/views/admin/contents/AdminReportAnalysis.vue";
import AdminUserManagement from "@/views/admin/contents/AdminUserManagement.vue";
import AdminSettings from "@/views/admin/contents/AdminSettings.vue";
import AdminAuditTrail from "@/views/admin/contents/AdminAuditTrail.vue";
import AdminProfile from "@/views/admin/contents/AdminProfile.vue";
import AdminViewUsers from "@/views/admin/contents/user-management/AdminViewUsers.vue";
import AdminRegisterUser from "@/views/admin/contents/user-management/AdminRegisterUser.vue";
import UserPersonalInfoForm from "@/views/admin/contents/user-management/user-registration-steps/UserPersonalInfoForm.vue";
import UserAccountInfoForm from "@/views/admin/contents/user-management/user-registration-steps/UserAccountInfoForm.vue";
import UserConfirmRegistration from "@/views/admin/contents/user-management/user-registration-steps/UserConfirmRegistration.vue";
import AdminViewLivestockAdvisories from "@/views/admin/contents/livestock-advisories/AdminViewLivestockAdvisories.vue";
import AdminViewAdvisory from "@/views/admin/contents/livestock-advisories/AdminViewAdvisory.vue";
import AdminComposeLivestockAdvisories from "@/views/admin/contents/livestock-advisories/AdminComposeLivestockAdvisories.vue";
import AdminLivestockManagement from "@/views/admin/contents/livestock-management/AdminLivestockManagement.vue";
import AdminLivestockTypeManagement from "@/views/admin/contents/livestock-management/AdminLivestockTypeManagement.vue";
import AdminLivestockBreedManagement from "@/views/admin/contents/livestock-management/AdminLivestockBreedManagement.vue";
import AdminLivestockAgeClassManagement from "@/views/admin/contents/livestock-management/AdminLivestockAgeClassManagement.vue";
import AdminLivestockBreedingParentOffspring from "@/views/admin/contents/livestock-breeding-management/AdminLivestockBreedingParentOffspring.vue"
import AdminLivestockBreedingRecordManagement from "@/views/admin/contents/livestock-breeding-management/AdminLivestockBreedingRecordManagement.vue"
import AdminLivestockPregnancyManagement from "@/views/admin/contents/livestock-breeding-management/AdminLivestockPregnancyManagement.vue"

// Farmer routes
import FarmerLayout from "@/views/farmer/layouts/FarmerLayout.vue";
import FarmerDashboard from "@/views/farmer/contents/FarmerDashboard.vue";
import FarmerLivestock from "@/views/farmer/contents/FarmerLivestock.vue";
import FarmerHistory from "@/views/farmer/contents/FarmerHistory.vue";
import FarmerNotification from "@/views/farmer/contents/FarmerNotification.vue";
import FarmerProfile from "@/views/farmer/contents/FarmerProfile.vue";
import FarmerLivestockManagement from "@/views/farmer/contents/farmer-livestock-mgmt/FarmerLivestockManagement.vue";
import FarmerLivestockVaccinationManagement from "@/views/farmer/contents/farmer-livestock-mgmt/FarmerLivestockVaccinationManagement.vue";
import FarmerLivestockBreedingManagement from "@/views/farmer/contents/farmer-livestock-mgmt/FarmerLivestockBreedingManagement.vue";
import FarmerEggProductionManagementVue from "@/views/farmer/contents/farmer-livestock-mgmt/FarmerEggProductionManagement.vue";
import FarmerLivestockMortalityManagement from "@/views/farmer/contents/farmer-livestock-mgmt/FarmerLivestockMortalityManagement.vue";
import FarmerLivestockPregnancyManagement from "@/views/farmer/contents/farmer-livestock-mgmt/FarmerLivestockPregnancyManagement.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/login",
            name: "LoginPage",
            component: LoginPage,
        },
        {
            path: "/admin",
            name: "AdminLayout",
            component: AdminLayout,
            children: [
                {
                    path: "dashboard",
                    name: "AdminDashboard",
                    component: AdminDashboard,
                },
                {
                    path: "livestock",
                    component: AdminLivestockMonitoring,
                    children: [
                        {
                            path: "",
                            name: "AdminLivestockMonitoring",
                            component: AdminLivestockManagement,
                        },
                        {
                            path: "livestock-types",
                            name: "AdminLivestockTypeMonitoring",
                            component: AdminLivestockTypeManagement,
                        },
                        {
                            path: "livestock-breeds",
                            name: "AdminLivestockBreedMonitoring",
                            component: AdminLivestockBreedManagement,
                        },
                        {
                            path: "livestock-age-classes",
                            name: "AdminLivestockAgeClassification",
                            component: AdminLivestockAgeClassManagement,
                        },
                    ],
                },
                {
                    path: "livestock-vaccinations",
                    name: "AdminLivestockVaccinationMonitoring",
                    component: AdminLivestockVaccinationMonitoring,
                },
                {
                    path: "livestock-breedings",
                    component: AdminLivestockBreedingMonitoring,
                    children:[
                        {
                            path: "",
                            name: "AdminLivestockBreedingMonitoring",
                            component: AdminLivestockBreedingParentOffspring,
                        },
                        {
                            path: "breeeding-records",
                            name: "AdminLivestockBreedingRecordManagement",
                            component: AdminLivestockBreedingRecordManagement,
                        },
                        {
                            path: "pregnancy-records",
                            name: "AdminLivestockPregnancyManagement",
                            component: AdminLivestockPregnancyManagement,
                        },
                    ]
                },
                {
                    path: "livestock-mortality",
                    name: "AdminLivestockMortalityMonitoring",
                    component: AdminLivestockMortalityMonitoring,
                },
                {
                    path: "report-analysis",
                    name: "AdminReportAnalysis",
                    component: AdminReportAnalysis,
                },
                {
                    path: "audit-trail",
                    name: "AdminAuditTrail",
                    component: AdminAuditTrail,
                },
                {
                    path: "livestock-advisories",
                    component: AdminLivestockAdvisories,
                    children: [
                        {
                            path: "",
                            name: "AdminLivestockAdvisories",
                            component: AdminViewLivestockAdvisories,
                        },
                        {
                            path: "",
                            name: "AdminComposeLivestockAdvisories",
                            component: AdminComposeLivestockAdvisories,
                        },
                        {
                            path: "advisory/:id",
                            name: "AdminAdvisory",
                            component: AdminViewAdvisory,
                        },
                    ],
                },
                {
                    path: "user-mgmt",
                    component: AdminUserManagement,
                    children: [
                        {
                            path: "users",
                            name: "AdminUserManagement",
                            component: AdminViewUsers,
                        },
                        {
                            path: "register-user",
                            component: AdminRegisterUser,
                            children: [
                                {
                                    path: "personal-info",
                                    name: "AdminRegisterUser",
                                    component: UserPersonalInfoForm,
                                },
                                {
                                    path: "account-info",
                                    name: "UserAccountInfoForm",
                                    component: UserAccountInfoForm,
                                },
                                {
                                    path: "confirm-registration",
                                    name: "UserConfirmRegistration",
                                    component: UserConfirmRegistration,
                                },
                            ],
                        },
                    ],
                },
                {
                    path: "settings",
                    name: "AdminSettings",
                    component: AdminSettings,
                },
                {
                    path: "profile",
                    name: "AdminProfile",
                    component: AdminProfile,
                },
            ],
        },
        {
            path: "/farm",
            name: "FarmerLayout",
            component: FarmerLayout,
            children: [
                {
                    path: "dashboard",
                    name: "FarmerDashboard",
                    component: FarmerDashboard,
                },
                {
                    path: "livestock",
                    component: FarmerLivestock,
                    children: [
                        {
                            path: "",
                            name: "FarmerLivestock",
                            component: FarmerLivestockManagement,
                        },
                        {
                            path: "vaccinations",
                            name: "FarmerLivestockVaccinations",
                            component: FarmerLivestockVaccinationManagement,
                        },
                        {
                            path: "breedings",
                            children:[
                                {
                                    path: "",
                                    name: "FarmerLivestockBreedings",
                                    component: FarmerLivestockBreedingManagement,
                                },
                                {
                                    path: "pregnancy",
                                    name: "FarmerLivestockPregnancy",
                                    component: FarmerLivestockPregnancyManagement,
                                },
                            ]
                        },
                        {
                            path: "egg-production",
                            name: "FarmerEggProduction",
                            component: FarmerEggProductionManagementVue,
                        },
                        {
                            path: "mortalities",
                            name: "FarmerLivestockMortalities",
                            component: FarmerLivestockMortalityManagement,
                        },
                    ],
                },
                {
                    path: "history",
                    name: "FarmerHistory",
                    component: FarmerHistory,
                },
                {
                    path: "notifications",
                    name: "FarmerNotification",
                    component: FarmerNotification,
                },
                {
                    path: "profile",
                    name: "FarmerProfile",
                    component: FarmerProfile,
                },
            ],
        },
    ],
});

export default router;
