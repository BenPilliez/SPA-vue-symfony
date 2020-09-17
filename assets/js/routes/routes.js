import Vue from 'vue'
import Router from 'vue-router'
import homePage from '../pages/Base/homePage'
import Login from "../pages/Login/Login";
import About from "../pages/Base/About";
import NotFound from "../pages/Base/NotFound"
import Register from "../pages/Register/Register";
import Email from "../pages/ResetPassword/Email-Pass"
import Confirmation from "../pages/Confirmation/Confirmation";


Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: homePage,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/confirmation',
            name: 'confirmation',
            component: Confirmation
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/reset',
            name: "reset",
            component: Email
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/404',
            name: 'NotFound',
            component: NotFound
        },
        {
            path: '*',
            redirect: '/404'
        }

    ]
})
export default router