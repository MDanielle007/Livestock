import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

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

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeView,
        },
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
                    name: "AdminLivestockMonitoring",
                    component: AdminLivestockMonitoring,
                },
                {
                    path: "livestock-vaccinations",
                    name: "AdminLivestockVaccinationMonitoring",
                    component: AdminLivestockVaccinationMonitoring,
                },
                {
                    path: "livestock-breedings",
                    name: "AdminLivestockBreedingMonitoring",
                    component: AdminLivestockBreedingMonitoring,
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
                    name: "AdminLivestockAdvisories",
                    component: AdminLivestockAdvisories,
                },
                {
                    path: "user-mgmt",
                    name: "AdminUserManagement",
                    component: AdminUserManagement,
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
    ],
});

export default router;
