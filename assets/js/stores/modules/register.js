import axios from "axios";

const state = () => ({
    status: '',
    auth_user: JSON.parse(localStorage.getItem('auth_user')) || null,
    isLogged: false,
})

const mutations = {
    status(state) {
        state.status = "Loading";
    }
}

const getters = {}

const actions = {
    register({commit, rootState}, user) {
        console.log(user)
        return new Promise((resolve, reject) => {
            axios({url: '/api/users', data: user, method: 'POST'})
                .then(resp => {
                    console.log(resp.data)
                    rootState.message = {
                        type: "success",
                        text: `Ton compte a bien été créé, un email de confirmation t'as été envoyé à ${resp.data.email}`
                    }
                    resolve(resp)

                })
                .catch(err => {
                    let violationArray = [];
                    err.response.data.violations.map((violation) => {
                        violationArray.push(violation.message);
                    })

                    rootState.message = {
                        type: "error",
                        text: violationArray.join('\n')
                    }
                    reject(err);
                })
        })
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}
