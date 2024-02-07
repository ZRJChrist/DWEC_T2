import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '@/views/auth/LoginView.vue'
import HomeCustomer from '@/views/customer/HomeCustomer.vue'
import HomePolicy from '@/views/policy/HomePolicy.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginView
    },
    {
      path: '/customers',
      name: 'customers',
      component: HomeCustomer
    },
    {
      path: '/policies',
      name: 'policies',
      component: HomePolicy
    },
  ]
})

export default router
