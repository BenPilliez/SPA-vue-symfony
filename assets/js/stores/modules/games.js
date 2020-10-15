import axios from "axios";


const state = () => ({
    games: {},
    favorite: null,
    gamesUsers: {}
})

const mutations = {

    games(state, game) {
        state.games[game.id] = game;
    },
    favorite(state, favorite) {
        state.favorite = favorite
    },

    gameUsers(state, users){
        state.gamesUsers[users.gameId] = users
    }


}

const getters = {
    games: state => state.games,
    favorite: state => state.favorite,
    gamesUsers: state => state.gamesUsers
}

const actions = {
    favorite({commit, rootState}) {
        return new Promise((resolve, reject) => {
            axios({
                url: `api/games`, method: 'GET',
                params: {"rate": 4}
            })
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
    gameById({commit, state, rootState}, data) {
        let exist = state.games[data.id];
        rootState.loading = true;
        if (exist !== undefined) {
            rootState.loading = false
            return exist;
        } else {
            return new Promise((resolve, reject) => {
                axios({url: `/api/games/${data.id}`, method: 'GET'})
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

    },
    gamesUser({commit, rootState}, game) {
        return new Promise((resolve, reject) => {
            axios({url: `/api/games/${game}/users`, method: 'GET'})
                .then((res) => {
                    res.data['hydra:member'].gameId = game;
                    commit('gameUsers', res.data['hydra:member']);
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
