import { createWebHistory, createRouter } from "vue-router";
import store from './store/index'

import Profile from "./components/ProfilePage.vue";
import Projects from "./components/ProjectsPage.vue";
import AddProject from "./components/AddProject.vue";

import Login from "./components/auth/LoginPage.vue";
import Register from "./components/auth/RegisterPage.vue";
import Verification from "./components/auth/VerificationPage.vue";
import PasswordReset from "./components/auth/PasswordReset.vue";
import RequestToken from "./components/auth/RequestToken.vue";


const routes = [
      {
        path: "/login",
        name: "Login",
        component: Login,
          meta: {
              noAuth: true
          }
      },
    {
        path: "/request-token",
        name: "RequestToken",
        component: RequestToken,
        meta: {
            noAuth: true
        }
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: {
            noAuth: true
        }
    },
    {
        path: "/password-reset",
        name: "PasswordReset",
        component: PasswordReset,
        meta: {
            noAuth: true
        }
    },
    {
        path: "/verification",
        name: "Verification",
        component: Verification,
        meta: {
            noAuth: true
        }
    },
    {
        path: "/",
        name: "Projects",
        component: Projects,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/project/:name",
        name: "AddProject",
        component: AddProject,
        meta: {
            requiresAuth: true
        }
    },
  {
    path: "/profile/:name",
    name: "Profile",
    component: Profile,
      meta: {
          requiresAuth: true
      }
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        if (!store.getters['getUser']) {
            next({path: '/login'})
        } else {
            next()
        }
    }
    else if (to.meta.noAuth) {
        if (store.getters['getUser']) {
            next({path: '/'})
        } else {
            next()
        }
    }
    else {
        next()
    }
});
export default router;
