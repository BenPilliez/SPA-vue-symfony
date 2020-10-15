import axios from "axios";

const state = () => ({
    users: {},
    userGames: {}
})

const mutations = {
    users(state, user) {
        state.users[user.id] = user
    },
    users_delete(state, user) {
        delete state.users[user];
    },
    userGames(state, games) {
        state.userGames[games.userId] = games
    }
}

const getters = {
    users: state => state.users,
    userGames: state => state.userGames
}

const actions = {
    findBy({commit, state, rootState}, data) {
        rootState.loading = true;
        let exist = state.users[data.id];
        if (exist !== undefined) {
            exist.isOwner = data.id == rootState.auth.auth_user.id;
            commit('users', exist)
            rootState.loading = false;
            return exist;
        } else {
            return new Promise((resolve, reject) => {
                axios({url: `/api/users/${data.id}`, method: 'GET'})
                    .then((resp) => {
                        rootState.loading = false;
                        resp.data.isOwner = resp.data.id === rootState.auth.auth_user.id;
                        commit('users', resp.data)
                        resolve(resp);
                    })
                    .catch((err) => {
                        rootState.loading = false;
                        console.log(err);
                        reject(err)
                    })
            })
        }
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
    },
    userGames({commit, rootState}, user) {
        return new Promise((resolve, reject) => {
            axios({url: `/api/users/${user}/games`, method: 'GET'})
                .then((res) => {
                    res.data['hydra:member'].userId = user;
                    commit('userGames', res.data['hydra:member']);
                    resolve(res);
                })
                .catch((error) => {
                    console.error(error);
                    reject(error);
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
