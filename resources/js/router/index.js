// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '../views/LoginPage.vue';
import RegisterPage from '../views/RegisterPage.vue';
import { auth } from '../firebase/config';

const routes = [
  {
    path: '/auth', // Rute dasar untuk Vue SPA ini
    redirect: '/auth/login', // Redirect default ke login
  },
  {
    path: '/auth/login',
    name: 'Login',
    component: LoginPage,
  },
  {
    path: '/auth/register',
    name: 'Register',
    component: RegisterPage,
  },
  // Anda bisa menambahkan rute lain yang akan diakses setelah login di sini
  {
    path: '/auth/homepage', // Contoh rute dashboard setelah login
    name: 'Homepage',
    component: { template: '<div>Homepage</div>' },
    meta: { requiresAuth: true } // Contoh: hanya bisa diakses jika sudah login
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Optional: Navigation Guard untuk rute yang membutuhkan autentikasi
router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const currentUser = auth.currentUser; // Ini membutuhkan 'auth' untuk di-import

    if (requiresAuth && !currentUser) {
        next('/auth/login');
    } else {
        next();
    }
});

export default router;
