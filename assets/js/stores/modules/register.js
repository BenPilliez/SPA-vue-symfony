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
                    err.response.data.violations.map((violation) => {
                        violationArray.push(violation.message);
                    })
                    rootState.loading = false;
                    rootState.message = {
                        type: "error",
                        text: violationArray.join('\n')
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
