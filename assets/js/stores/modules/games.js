import axios from "axios";


const state = () => ({
    games: null,
    favorite: null
})

const mutations = {

    games(state, games) {
        state.games = games;
    },
    favorite(state, favorite) {
        state.favorite = favorite
    }

}

const getters = {
    games: state => state.games,
    favorite: state => state.favorite
}

const actions = {
    favorite({commit, rootState}) {
        return new Promise((resolve, reject) => {
            axios({url: `api/games/`, method: 'GET',
                params: {"rate[gte]": 4, itemsPerPage: 10}})
                .then((resp) => {
                    commit('favorite', resp.data['hydra:member']);
                    resolve(resp)
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
