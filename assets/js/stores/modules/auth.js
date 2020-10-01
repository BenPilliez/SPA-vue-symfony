import axios from "axios";
import setAuthorizationToken from "../../helpers/axios";

const state = () => ({
    status: '',
    auth_user: JSON.parse(localStorage.getItem('auth_user')) || null,
    isLogged: false,
})

const mutations = {
    status(state) {
        state.status = "Loading";
    },
    auth_success(state, token) {
        state.status = "success";
        state.token = token;
    },
    auth_user(state, user) {
        state.auth_user = user;
    },
    isLogged(state, result) {
        state.isLogged = result;
    }

}

const getters = {
    auth_user: state => state.auth_user,
    isLogged: state => state.isLogged,
}

const actions = {
    login({commit, dispatch, rootState}, user) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            commit('status')
            axios({url: '/api/login_check', data: user, method: "POST"})
                .then((resp) => {

                    localStorage.setItem('token', resp.data.token.token);
                    localStorage.setItem('refresh_token', resp.data.refresh_token)
                    setAuthorizationToken(resp.data.token.token);
                    rootState.message = {
                        type: 'success',
                        text: 'Connexion réussie'
                    }
                    dispatch('authUser', resp.data.user)
                        .then((response) => {
                            localStorage.setItem('auth_user', JSON.stringify(response.data));
                            commit('isLogged', true);
                            commit('auth_user', response.data);
                            rootState.loading = false;
                            rootState.message = {
                                type: 'success',
                                text: 'Connexion réussie'
                            }
                            resolve(resp);

                        })
                        .catch((error) => {
                            rootState.loading = false;

                            rootState.error = {type: 'error', text: error.response.data.message};
                            console.error(error)
                            localStorage.clear();
                        })
                })
                .catch((error) => {
                    rootState.loading = false;

                    rootState.message = {type: 'error', text: error.response.data.message};
                    localStorage.clear();
                    reject(error);
                })
        })
    },
    authUser({commit, rootState}, id) {
        return new Promise((resolve, reject) => {
            axios({url: `/api/users/${id}`, method: "GET"})
                .then((resp) => {
                    resolve(resp);
                })
                .catch((error) => {
                    reject(error);
                })
        })
    },
    logout({state, rootState}) {
        // On remove le header
        setAuthorizationToken();
        localStorage.clear();
        rootState.message = {
            type: 'success',
            text: 'Vous êtes bien déconnecté'
        }
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
