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
import vSelect from "vue-select";
import checkToken from "./checkToken";
import decode from "./jwtDecode";
import refreshToken from "./checkToken";
import auth from "../stores/modules/auth";

export default class VueClass {
    static init() {

        const token = localStorage.getItem('token');

        if (token) {
            setAuthorizationToken(token);
        }

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

        router.beforeEach(async (to, from, next) => {
            if (to.query.success === "true" && to.name === "confirmation" && localStorage.auth_user) {
                let auth_user = JSON.parse(localStorage.auth_user);
                auth_user.isVerified = true;
                localStorage.setItem('auth_user', JSON.stringify(auth_user));
                store.commit('auth_user', auth_user);
            }
            if (localStorage.token) {
                let token = decode(localStorage.getItem('token'));
                if (token.exp < Date.now() / 1000) {
                    let response = await refreshToken();
                    setAuthorizationToken(response.token.token);
                    localStorage.setItem('token', response.token.token)
                    localStorage.setItem('refresh_token', response.refresh_token)
                }
            } else {
                next();
            }
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


        Vue.use(BootstrapVue);
        Vue.use(BootstrapVueIcons);
        Vue.use(Notifications);
        Vue.use(loader);

        Vue.component("v-select", vSelect);
        Vue.component("ValidationObserver", ValidationObserver);
        Vue.component("ValidationProvider", ValidationProvider);

        Object.keys(rules).forEach(rule => {
            extend(rule, {
                ...rules[rule], // copies rule configuration
                message: messages[rule] // assign message
            });
        });

        extend('url', {
            validate(value) {
                if (value) {
                    return /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(value);
                }

                return false;
            },
            message: "T'es sur que c'est une url ?",
        })

        new Vue({
            el: '#app',
            store,
            router,
            template: '<App />',
            components: {App},
        })
    }
}
