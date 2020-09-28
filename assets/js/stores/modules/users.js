import axios from "axios";

const state = () => ({
    users: {},
})

const mutations = {
    users(state, user) {
        state.users[user.id] = user
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
    update_password({commit, rootState}, form) {
        rootState.loading = true
        return new Promise((resolve, reject) => {
            axios({url: `/api/users/${form.id}/password/update`, data: form, method: 'PUT'})
                .then((resp) => {
                    rootState.loading = false;
                    rootState.message = {
                        type: 'success',
                        text: 'Mot de passe mis à jour '
                    }
                    resolve(resp)
                }).catch((err) => {
                console.log(err.response)

                rootState.message = {
                    type: 'error',
                    text: err.response.data.error
                }
                rootState.loading = false
                reject(err)
            })
        })
    },

    platform({commit, rootState}, form){
        rootState.loading = true;
        return new Promise((resolve,reject) => {
            axios({url: form.url, data:form, method: form.method,})
                .then((resp) => {
                    rootState.loading = false;

                    rootState.message = {
                        type:'success',
                        text:'Profil mis à jour'
                    }

                    resolve(resp);
                }).catch((err) => {

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
                    text = 'Oops on a eu problème Houston'
                }

                rootState.loading = false;
                rootState.message = {
                    type: "error",
                    text: text
                }
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
