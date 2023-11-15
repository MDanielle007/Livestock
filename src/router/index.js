import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'

// Admin routes
import AdminLayout from '@/views/admin/layouts/AdminLayout.vue'
import AdminDashboard from '../views/admin/contents/AdminDashboard.vue'
import AdminLivestockManagement from '../views/admin/contents/AdminLivestockManagement.vue'
import AdminReportAnalytics from '../views/admin/contents/AdminReportAnalytics.vue'
import AdminAuditTrail from '../views/admin/contents/AdminAuditTrail.vue'
import AdminUserManagement from '../views/admin/contents/AdminUserManagement.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component:LoginView
  },
  {
    path: '/admin',
    name: 'admin',
    component:AdminLayout,
    children: [
      {
        path: 'dashboard',
        name: 'admin-dashboard',
        component:AdminDashboard
      },
      {
        path: 'livestocks',
        name: 'admin-livestock',
        component:AdminLivestockManagement
      },
      {
        path: 'report-analytics',
        name: 'admin-report-analytics',
        component:AdminReportAnalytics
      },
      {
        path: 'audit',
        name: 'admin-audit',
        component:AdminAuditTrail
      },
      {
        path: 'user-management',
        name: 'admin-user-manage',
        component:AdminUserManagement
      },
    ]
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
