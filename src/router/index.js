import { createRouter, createWebHistory } from 'vue-router'
import { jwtDecode as jwt_decode } from 'jwt-decode';
import { getCookie } from '@/utils/cookieUtils.js'

import LoginView from '../views/LoginView.vue'
import ForbiddenView from '../views/ForbiddenView.vue'


//Admin Dashboard Routes
import AdminLayout from '../views/admin/layouts/AdminLayout.vue'
import AdminDashboard from '../views/admin/contents/AdminDashboard.vue'
import AdminLivestockManagement from '../views/admin/contents/AdminLivestockManagement.vue'
import AdminLivestockMonitoring from '../views/admin/contents/AdminLivestockMonitoring.vue'
import AdminReportAnalytics from '../views/admin/contents/AdminReportAnalytics.vue'
import AdminAuditTrail from '../views/admin/contents/AdminAuditTrail.vue'
import AdminUserManagement from '../views/admin/contents/AdminUserManagement.vue'
import AdminRegisterAccount from '../views/admin/contents/AdminRegisterAccount.vue'
import LivestockTable from '@/components/admin/tables/LivestockTable.vue';
import LivestockTypesTable from '@/components/admin/tables/LivestockTypesTable.vue';
import AdminBreedingMonitoring from '@/views/admin/contents/AdminBreedingMonitoring.vue'
import AdminMortalityMonitoring from '@/views/admin/contents/AdminMortalityMonitoring.vue'


// Farmer Portal Routes
import FarmerLayout from '../views/farmer/layouts/FarmerLayout.vue'
import FarmerHome from '../views/farmer/contents/FarmerHome.vue'
import FarmerLivestock from '../views/farmer/contents/FarmerLivestock.vue'
import FarmerNotifications from '../views/farmer/contents/FarmerNotifications.vue'
import FarmerDataHistory from '../views/farmer/contents/FarmerDataHistory.vue'
import FarmerProfile from '../views/farmer/contents/FarmerProfile.vue'


const routes = [
  {
    path: '/',
    name: 'default',
    component: LoginView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/forbidden',
    name: 'forbidden',
    component: ForbiddenView
  },
  {
    path: '/admin',
    name: 'admin',
    component: AdminLayout,
    // meta: { requiresAuth: true, allowedRoles: ['DA Personnel'] },
    children:[
      {
        path:'dashboard',
        name:'admin-dashboard',
        component: AdminDashboard,
      },
      {
        path:'livestock-monitoring',
        component:AdminLivestockMonitoring,
        children:[
          {
            path:'',
            name:'admin-livestock-monitoring',
            component: LivestockTable,
          },
          {
            path:'livestock-types',
            name:'livestock-types',
            component: LivestockTypesTable,
          },
        ]
      },
      {
        path:'livestock-management',
        name:'admin-livestock-management',
        component: AdminLivestockManagement,
      },
      {
        path:'breeding-monitoring',
        name:'admin-breeding-monitoring',
        component: AdminBreedingMonitoring,
      },
      {
        path:'mortality-monitoring',
        name:'admin-mortality-monitoring',
        component: AdminMortalityMonitoring,
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
    // meta: { requiresAuth: true, allowedRoles: ['Farmer'] },
    children:[
      {
        path:'home',
        name:'Farmer Dashboard',
        component:FarmerHome
      },
      {
        path:'livestock',
        name:'Farmer Livestocks',
        component:FarmerLivestock
      },
      {
        path:'history',
        name:'History',
        component:FarmerDataHistory
      },
      {
        path:'notification',
        name:'Notifications',
        component:FarmerNotifications
      },
      {
        path:'profile',
        name:'Farmer Profile',
        component:FarmerProfile
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
  // const found = router.options.routes.some(route => route.path === to.path);

  // if (!found && to.path !== '/forbidden') {
  //   next('/forbidden');
  // }

  // Fetch the token from the HTTP-only cookie
  const token = getCookie('token');

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
