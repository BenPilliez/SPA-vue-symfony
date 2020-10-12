import axios from "axios";


const state = () => ({
    games: {},
    favorite: null
})

const mutations = {

    games(state, game) {
        state.games[game.id] = game;
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
    },
    gameById({commit, state, rootState}, data){
        let exist = state.games[data.id];
        rootState.loading = true;
        if(exist !== undefined){
            rootState.loading = false
            return exist;
        }else{
            return new Promise((resolve,reject) => {
                axios({url: `/api/games/${data.id}`, method:'GET'})
                    .then((res) => {
                        commit('games', res.data)
                        rootState.loading = false;
                        resolve(res.data)
                    })
                    .catch((err) => {
                        rootState.loading = false;
                        reject(err);
                    })
            })
        }

    }

}

export default {
    state,
    getters,
    actions,
    mutations
}
