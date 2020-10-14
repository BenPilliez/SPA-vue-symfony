import axios from "axios";

const state = () => ({

})

const mutations = {}

const getters = {
}

const actions = {
    rate({commit,state, rootState}, form){
        return new Promise((resolve, reject) => {
            axios({url: form.url, method:form.method, data:form} )
                .then((res) => {
                    resolve(res)
                })
                .catch((error) => {
                    reject(error)
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
