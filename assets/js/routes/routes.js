import Vue from 'vue'
import Router from 'vue-router'
import homePage from '../pages/Base/homePage'
import Login from "../pages/Login/Login";
import About from "../pages/Base/About";
import NotFound from "../pages/Base/NotFound"
import Register from "../pages/Register/Register";
import Email from "../pages/ResetPassword/Email-Pass"
import Confirmation from "../pages/Confirmation/Confirmation";
import Reset from "../pages/ResetPassword/Reset";
import User from "../pages/User/User";
import Profile from "../pages/User/Profile";
import ProfileEdit from "../pages/User/ProfileEdit"
import Mentions from "../pages/Base/Mentions";
import Users from "../pages/Base/UsersList";


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
            path: '/user/:id', component: User,
            children: [
                {path: '', name: "profile", component: Profile},
                {path: 'edit', name: "edit", component: ProfileEdit},
            ],
            meta: {requiresAuth: true}
        },
        {
            path: '/users', component: Users,
            name:"users",
            meta:{requiresAuth: true}
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
            path: '/mentions',
            name: 'mentions',
            component: Mentions,
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
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/reset',
            name: "reset",
            component: Reset
        },
        {
            path: '/reset_form',
            name: "reset_form",
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