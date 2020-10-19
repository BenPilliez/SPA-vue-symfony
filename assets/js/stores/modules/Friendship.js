import axios from "axios";

const state = () => ({
    friendsRequest: {},
    friends: {}
})

const mutations = {
    friendsRequest(state, request) {
        state.friendsRequest[request.user] = request
    },

    friends(state, friends) {
        state.friends[friends.user] = friends
    }
}

const getters = {
    friendsResquest: state => state.friendsRequest,
    friends: state => state.friends
}

const actions = {
    friendsRequest({state, commit, rootState}, data) {
        return new Promise((resolve, reject) => {
            axios({url: '/api/friendships', data: data, method: 'POST'})
                .then((res) => {
                    console.log(res);
                    commit('friendsRequest', data)
                    resolve(res);
                })
                .catch((err) => {
                    console.error(err);
                    reject(err);
                })
        })
    },
    friendsList({state, commit, rootState}, data) {
        return new Promise((resolve, reject) => {
            axios({url: '/api/friendships', method: 'GET', params: {user: data}})
                .then((res) => {
                    console.log(res);
                    resolve(res);
                })
                .catch((err) => {
                    console.error(err);
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
