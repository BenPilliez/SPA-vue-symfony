import axios from "axios";

const state = () => ({
    registrations: null
})

const mutations = {
    registrations(state, number) {
        state.registrations = number;
    }
}

const getters = {
    registrations: state => state.registrations
}

const actions = {
    register({commit, rootState}, user) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: '/api/users', data: user, method: 'POST'})
                .then(resp => {
                    rootState.message = {
                        type: "success",
                        text: `Ton compte a bien été créé, un email de confirmation t'as été envoyé à ${resp.data.email}`
                    }

                    rootState.loading = false;
                    resolve(resp)

                })
                .catch(err => {
                    let violationArray = [];
                    let text;
                    if (err.response.data.violations) {
                        err.response.data.violations.map((violation) => {
                            violationArray.push(violation.message);
                        })
                        text = violationArray.join('\n');
                    } else if (err.response.data.error) {
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
    registrations({commit}) {
        return new Promise((resolve, reject) => {
            axios({url: `/api/registrations`, method: 'GET'})
                .then((resp) => {
                    commit('registrations', resp.data['hydra:totalItems']);
                    resolve(resp);
                })
                .catch((err) => {
                    console.error(err);
                    reject(err)
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
