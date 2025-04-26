import './assets/main.css'

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router';

import App from './App.vue'
import Home from "@/Home.vue";
import ViewSingle from "@/ViewSingle.vue";
import Login from "@/Login.vue";
import Cart from "@/Cart.vue";

const routes = [
  { name: 'home', path: '/', component: Home },
  { name: 'single', path: '/product/:productId', component: ViewSingle },
  { name: 'login', path: '/login', component: Login },
  { name: 'cart', path: '/cart', component: Cart },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
});

const app = createApp(App);

app.use(router)
  .mount('#app')
