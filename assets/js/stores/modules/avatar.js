import axios from 'axios';

const state = () => ({
    file: '',

})

const mutations = {
    file(state, file) {
        state.file = file;
    }
}

const getters = {
    file: state => state.file
}

const actions = {
    upload({commit, rootState}, form) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {

            let url = form.url !== null ? form.url : `/api/media_objects`

            axios.headers = form.selectedAvatar === null ? 'headers' : {
                'Content-Type': 'multipart/form-data'
            }

            axios({
                url: url, data: form.formData, method: form.method,

            })
                .then(resp => {
                    rootState.loading = false
                    rootState.message = {
                        type: 'success',
                        text: 'Ton avatar à été mis à jour'
                    }
                    commit('file', resp.data)
                    resolve(resp);
                }).catch(err => {
                console.log(err)
                rootState.loading = false;
                rootState.message = {
                    type: 'error',
                    text: 'Oops on a un problème'
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