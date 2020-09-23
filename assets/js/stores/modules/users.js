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
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
