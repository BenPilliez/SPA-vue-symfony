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
    findAll({commit, state, rootState}) {
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
            if (state.users[data.id] !== undefined) {
                state.users[data.id].isOwner = data.id == rootState.auth.auth_user.id;
                state.users[data.id].edit = data.edit;
                rootState.loading = false;
                resolve(state.users[data.id]);
            } else {
                axios({url: `/api/users/${data.id}`, method: 'GET'})
                    .then((resp) => {
                        rootState.loading = false;
                        state.users[data.id] = resp.data
                        state.users[data.id].isOwner = resp.data.id === rootState.auth.auth_user.id;
                        state.users[data.id].edit = data.edit;
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
