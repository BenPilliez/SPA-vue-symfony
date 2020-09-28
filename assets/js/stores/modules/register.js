import axios from "axios";

const state = () => ({})

const mutations = {}

const getters = {}

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
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
