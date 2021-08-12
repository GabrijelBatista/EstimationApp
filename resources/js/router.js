import { createWebHistory, createRouter } from "vue-router";
import store from './store/index'

import HomePage from "./components/HomePage.vue";
import Profile from "./components/ProfilePage.vue";
import Projects from "./components/ProjectsPage.vue";
import AddProject from "./components/AddProject.vue";

import Login from "./components/auth/LoginPage.vue";
import Register from "./components/auth/RegisterPage.vue";
import RequestToken from "./components/auth/RequestToken.vue";
import Verification from "./components/auth/VerificationPage.vue";
import PasswordReset from "./components/auth/PasswordReset.vue";


const routes = [
  {
    path: "/",
    name: "Home",
    component: HomePage,
  },

      {
        path: "/login",
        name: "Login",
        component: Login,
      },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/password-reset",
        name: "PasswordReset",
        component: PasswordReset,
    },
    {
        path: "/verification",
        name: "Verification",
        component: Verification,
    },
    {
        path: "/request-token",
        name: "RequestToken",
        component: RequestToken,
    },
    {
        path: "/projects",
        name: "Projects",
        component: Projects,
    },
    {
        path: "/project/:name",
        name: "AddProject",
        component: AddProject,
    },
  {
    path: "/profile/:name",
    name: "Profile",
    component: Profile,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        if (!store.getters['getUser']) {
            next({path: '/admin-login'})
        } else {
            next()
        }
    }
    else {
        next()
    }
});
export default router;
