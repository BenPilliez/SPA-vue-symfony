import axios from "axios";

const state = () => ({
    users: {},
})

const mutations = {
    users(state, user) {
        state.users[user.id] = user
    },
    users_delete(state, user) {
        delete state.users[user];
    }
}

const getters = {
    users: state => state.users
}

const actions = {
    findAll({commit, rootState}) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: '/api/users', method: "GET"})
                .then((resp) => {
                    resp.data['hydra:member'].map((user) => {
                        commit('users', user)
                    })
                    rootState.loading = false;
                    resolve(resp)
                })
                .catch((err) => {
                    rootState.loading = false;
                    console.log(err);
                    reject(err)
                })
        })
    },
    findBy({commit, state, rootState}, data) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            if (data.user !== null) {
                data.user.isOwner = data.id == rootState.auth.auth_user.id;
                data.user.edit = data.edit;
                commit('users', data.user)
                rootState.loading = false;
                resolve(data.user);
            } else {
                axios({url: `/api/users/${data.id}`, method: 'GET'})
                    .then((resp) => {
                        rootState.loading = false;
                        resp.data.isOwner = resp.data.id === rootState.auth.auth_user.id;
                        resp.data.edit = data.edit;
                        commit('users', resp.data)
                        resolve(resp);
                    })
                    .catch((err) => {
                        rootState.loading = false;
                        console.log(err);
                        reject(err)
                    })
            }
        })
    },
    delete({commit, rootState}, user) {
        return new Promise((resolve, reject) => {
            axios({url: `/api/users/${user}`, method: 'DELETE'})
                .then((resp) => {
                    rootState.message = {
                        type: 'success',
                        text: "Ton compte a bien été supprimé, merci d'être passé"
                    }
                    commit('users_delete', user);
                    resolve(resp);
                })
                .catch((err) => {

                    let violationArray = [];
                    let text;
                    if (err.response && err.response.data.violations) {
                        err.response.data.violations.map((violation) => {
                            violationArray.push(violation.message);
                        })
                        text = violationArray.join('\n');
                    } else if (err.response && err.response.data.error) {
                        text = err.response.data.error;
                    } else {
                        text = 'Apparement tu ne dois pas supprimer ton compte '
                    }

                    rootState.loading = false;
                    rootState.message = {
                        type: "error",
                        text: text
                    }
                    reject(err);
                })
        })
    },
    sendConfirmEmail({commit, rootState}, form) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: '/api/registrations', data: form, method: 'POST'})
                .then((resp) => {
                    rootState.loading = false;
                    rootState.message = {
                        type: "success",
                        text: resp.data.message
                    }

                    resolve(resp)
                }).catch((err) => {
                rootState.loading = false;
                let message = {
                    type: 'error', text: 'Oops, contact un admin à admin@benpilliez.fr'
                }

                if (err.response.data && err.response.data.error) {
                    message.text = err.response.data.error
                }

                rootState.message = message

                reject(err);
            })
        })
    }

}

export default {
    state,
    getters,
    actions,
    mutations
}
