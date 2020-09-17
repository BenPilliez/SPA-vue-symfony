import Vue from 'vue'
import Vuex from 'vuex'
import Auth from "./modules/auth"
import Register from "./modules/register";
import ResetPassword from "./modules/reset_password"

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        loading: false,
        message: null,
        users: {},
    },
    modules: {
        auth: Auth,
        register: Register,
        reset: ResetPassword,
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
        users: state => state.users,
        message: state => state.message,
        loading: state => state.loading
    }
})