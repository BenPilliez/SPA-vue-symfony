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

                    resp.data['hydra:member'].map((user) =>{
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
    findBy({commit, state, rootState}, id) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: `/api/users/${id}`, method: 'GET'})
                .then((resp) => {
                    rootState.loading = false;
                    state.users[id] = resp.data
                    state.users[id].isOwner = resp.data.id === rootState.auth.auth_user.id ;
                    resolve(resp);
                })
                .catch((err) => {
                    rootState.loading = false;
                    console.log(err);
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
