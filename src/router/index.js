import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'


//Admin Dashboard Routes
import AdminLayout from '../views/admin/layouts/AdminLayout.vue'
import AdminDashboard from '../views/admin/contents/AdminDashboard.vue'
import AdminLivestock from '../views/admin/contents/AdminLivestockManagement.vue'
import AdminReportAnalytics from '../views/admin/contents/AdminReportAnalytics.vue'
import AdminAuditTrail from '../views/admin/contents/AdminAuditTrail.vue'
import AdminUserManagement from '../views/admin/contents/AdminUserManagement.vue'
import AdminRegisterAccount from '../views/admin/contents/AdminRegisterAccount.vue'


// Farmer Portal Routes
import FarmerLayout from '../views/farmer/layouts/FarmerLayout.vue'
import FarmerHome from '../views/farmer/contents/FarmerHome.vue'
import FarmerLivestock from '../views/farmer/contents/FarmerLivestock.vue'
import FarmerSales from '../views/farmer/contents/FarmerSales.vue'
import FarmerDataHistory from '../views/farmer/contents/FarmerDataHistory.vue'
import FarmerProfile from '../views/farmer/contents/FarmerProfile.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/admin',
    name: 'admin',
    component: AdminLayout,
    children:[
      {
        path:'dashboard',
        name:'admin-dashboard',
        component: AdminDashboard,
      },
      {
        path:'livestock-management',
        name:'admin-livestock-management',
        component:AdminLivestock
      },
      {
        path:'report',
        name:'admin-report-analytics',
        component:AdminReportAnalytics
      },
      {
        path:'audit',
        name:'admin-audit-trail',
        component:AdminAuditTrail
      },
      {
        path:'user-management',
        name:'admin-user-management',
        component:AdminUserManagement
      },
      {
        path:'register-user',
        name:'register-account',
        component:AdminRegisterAccount
      }
    ]
  },
  {
    path:'/farmer',
    name:'farmer',
    component:FarmerLayout,
    children:[
      {
        path:'home',
        name:'farmer-home',
        component:FarmerHome
      },
      {
        path:'livestock',
        name:'farmer-livestock',
        component:FarmerLivestock
      },
      {
        path:'sales',
        name:'farmer-sales',
        component:FarmerSales
      },
      {
        path:'history',
        name:'farmer-data-history',
        component:FarmerDataHistory
      },
      {
        path:'profile',
        name:'farmer-profile',
        component:FarmerProfile
      },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
