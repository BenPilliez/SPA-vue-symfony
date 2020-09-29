import Vue from 'vue'
import Vuex from 'vuex'
import Auth from "./modules/auth"
import Register from "./modules/register";
import ResetPassword from "./modules/reset_password"
import Users from "./modules/users";
import Ajax from "./modules/ajaxLoad"
import Form from "./modules/form";
import Avatar from "./modules/avatar";
import setAuthorizationToken from "../helpers/axios"
import axios from "axios";

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
        users: Users,
        ajax: Ajax,
        form: Form,
        avatar: Avatar
    },
    mutations: {
        message(state, message) {
            state.message = {
                type: message.type,
                text: message.text
            }
        },
        message_null(state) {
            state.message = null
        }
    },
    actions: {
        refresh_token({commit}) {
            return new Promise((resolve, reject) => {
                axios({url: ' /api/token/refresh', data: localStorage.getItem('refresh_token'), method: 'POST'})
                    .then((resp) => {
                        console.log(resp.data);
                        /*localStorage.setItem('token', resp.data);
                        setAuthorizationToken(resp.data)*/
                    })
            })
        }
    },

    getters: {
        message: state => state.message,
        loading: state => state.loading
    }
})