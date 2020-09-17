import Vue from 'vue';
import router from '../routes/routes';
import App from '../views/App';
import {store} from "../stores/index";
import setAuthorizationToken from "./axios";
import {BootstrapVue, BootstrapVueIcons} from 'bootstrap-vue'
import {ValidationProvider, ValidationObserver, extend} from 'vee-validate';
import * as rules from 'vee-validate/dist/rules'
import {messages} from 'vee-validate/dist/locale/fr.json';
import Notifications from 'vue-notification'
import loader from "vue-ui-preloader";


export default class VueClass {
    static init() {

        // On maintient la connexion pendant 24h
        let hours = 24; // Reset when storage is more than 24hours
        let now = new Date().getTime();
        let setupTime = localStorage.getItem('setupTime');
        if (setupTime == null) {
            localStorage.setItem('setupTime', now);
        } else {
            if (now - setupTime > hours * 60 * 60 * 1000) {
                localStorage.clear();
                localStorage.setItem('setupTime', now);
            }
        }

        router.beforeEach((to, from, next) => {
            if (to.matched.some(record => record.meta.requiresAuth)) {
                // this route requires auth, check if logged in
                // if not, redirect to login page.
                if (!localStorage.getItem('auth_user')) {

                    next('/login')
                } else {

                    next(); // go to wherever I'm going
                }
            } else {
                next(); // does not require auth, make sure to always call next()!
            }
        })

        const token = localStorage.getItem('token');

        if (token) {
            setAuthorizationToken(token);
        }

        Vue.use(BootstrapVue);
        Vue.use(BootstrapVueIcons);
        Vue.use(Notifications);
        Vue.use(loader);

        Vue.component("ValidationObserver", ValidationObserver);
        Vue.component("ValidationProvider", ValidationProvider);

        Object.keys(rules).forEach(rule => {
            extend(rule, {
                ...rules[rule], // copies rule configuration
                message: messages[rule] // assign message
            });
        });

        new Vue({
            el: '#app',
            store,
            router,
            template: '<App />',
            components: {App},
        })
    }
}
