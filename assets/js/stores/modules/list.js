import axios from "axios";

const state = () => ({
    all: {},
    search:{},
})

const mutations = {

}

const getters = {
    all: state => state.all,
    search: state => state.search
}

const actions = {
    findAll({commit,state, rootState}, options) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: options.url, method: "GET",
                params:{pagination: true,page:options.page, itemsPerPage: options.perPage}})
                .then((resp) => {
                    state.all[options.type ] ={};
                    state.all[options.type][options.page] = resp.data['hydra:member'];
                    state.all[options.type][options.page]['rows'] = resp.data['hydra:totalItems'];
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
    findAllWithSearch({commit,state, rootState}, options) {
        rootState.loading = true;
        let params = {
            pagination: true,
            page: options.page,
            itemsPerPage: options.perPage
        }
        if(options.type === "users") {
            params.username = options.value
        }else{
            params.name = options.value
        }

        return new Promise((resolve, reject) => {
            axios({url: options.url , method: "GET",
                params:params})
                .then((resp) => {
                    state.search[options.type ] ={};

                    state.search[options.type][`${options.value}-${options.page}`] = resp.data['hydra:member']
                    state.search[options.type][`${options.value}-${options.page}`]['rows'] = resp.data['hydra:totalItems']
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


}

export default {
    state,
    getters,
    actions,
    mutations
}
