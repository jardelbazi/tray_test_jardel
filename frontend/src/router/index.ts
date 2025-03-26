import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import GoogleAuthRedirect from '@/views/GoogleAuthRedirect.vue';
import UserProfile from '@/views/UserProfile.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/google-auth', component: GoogleAuthRedirect },
  { path: '/user/:googleId', component: UserProfile, props: true },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;