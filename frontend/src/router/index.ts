import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import GoogleAuthRedirect from '@/views/GoogleAuthRedirect.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/google-auth', component: GoogleAuthRedirect },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;