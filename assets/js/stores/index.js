import Vue from 'vue'
import Vuex from 'vuex'
import Auth from "./modules/auth"
import Register from "./modules/register";
import ResetPassword from "./modules/reset_password"
import Users from "./modules/users";

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        loading: false,
        message: null,
    },
    modules: {
        auth: Auth,
        register: Register,
        reset: ResetPassword,
        users: Users
    },
    mutations: {
        message(state, message) {
            state.message = {
                type: message.type,
                text: message.text
            }
        },
        message_null(state){
            state.message = null
        }
    },

    getters: {
        message: state => state.message,
        loading: state => state.loading
    }
})