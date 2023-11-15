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

// Farmer routes
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
    {
        path: '/farmer',
        name: 'farmer',
        component:FarmerLayout,
        children:[
            {
                path: 'home',
                name: 'farmer-home',
                component:FarmerHome,
            },
            {
                path: 'livestock',
                name: 'farmer-livestock',
                component:FarmerLivestock,
            },
            {
                path: 'sales',
                name: 'farmer-sales',
                component:FarmerSales,
            },
            {
                path: 'history',
                name: 'farmer-data-history',
                component:FarmerDataHistory,
            },
            {
                path: 'profile',
                name: 'farmer-profile',
                component:FarmerProfile,
            },
        ]
    }

]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

// Navigation Guard
router.beforeEach((to, from, next) => {
    const token = sessionStorage.getItem('token');
  
    // If the route requires authentication
    if (to.meta.requiresAuth) {
      if (!token) {
        // Redirect to login if the user is not authenticated
        next('/login');
      } else {
        const decodedToken = jwt_decode(token);
        const userRole = decodedToken.aud;
  
        // Check if the user has the required role for the route
        if (to.meta.allowedRoles.includes(userRole)) {
          // Proceed to the route
          next();
        } else {
          // Redirect to a forbidden page or handle unauthorized access
          next('/forbidden');
        }
      }
    } else {
      // If the route doesn't require authentication, proceed
      next();
    }
  });

export default router
