import axios from "axios";
import {EventBus} from "../../helpers/event-bus";


const state = () => ({})

const mutations = {}

const getters = {}

const actions = {

    send({commit, rootState}, {form, url}) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: url, data: form, method: form.method})
                .then((resp) => {

                    rootState.message = {
                        type: 'success',
                        text: 'Ton profile a été mis à jour'
                    };

                    rootState.loading = false;
                    let auth_user = JSON.parse(localStorage.getItem('auth_user'));

                    if (form.type === "hardware") {
                        auth_user.userConfig = resp.data
                    } else if (form.type === "user") {
                        auth_user = resp.data
                    }

                    localStorage.setItem('auth_user', JSON.stringify(auth_user));

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
    },
    dispo({commit, rootState}, form) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: form.url, data: {form: form, user_id: form.user.id}, method: form.method})
                .then((resp) => {
                    rootState.loading = false;
                    rootState.message = {
                        type: 'success',
                        text: 'Tes dispo ont bien été save'
                    }
                    resolve(resp)
                })
                .catch((err) => {
                    console.error(err);
                    rootState.loading = false;
                    reject(err)
                })
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

    platform({commit, rootState}, form) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: form.url, data: form, method: form.method,})
                .then((resp) => {
                    rootState.loading = false;

                    rootState.message = {
                        type: 'success',
                        text: 'Profil mis à jour'
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
