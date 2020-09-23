import axios from "axios";


const state = () => ({
    result: null
})

const mutations = {

    result(state, result) {
        state.result = result;
    }

}

const getters = {
    result: state => state.result
}

const actions = {
    country({commit, rootState}, search) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: `/search/mapbox`, data: search, method: 'POST'})
                .then(resp => {
                    commit('result', resp.data.features);
                    rootState.loading = false
                    resolve(resp);
                }).catch(err => {
                rootState.message = {
                    type: 'error',
                    text: err.response.data
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
