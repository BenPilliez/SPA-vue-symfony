import axios from "axios";

const state = () => ({})

const mutations = {}

const getters = {}

const actions = {
    reset_password({commit, rootState}, form) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: '/api/reset_password_requests', data: form, method: 'POST'})
                .then(resp => {
                    rootState.message = {
                        type: "success",
                        text: `Un email pour modifier ton mot de passe t'as été envoyé`
                    }

                    rootState.loading = false;
                    resolve(resp);

                })
                .catch(err => {
                    console.log(err.response)
                    rootState.loading = false;
                    rootState.message = {
                        type: "error",
                        text: ''
                    }

                    reject(err);
                })
        })
    },
    reset({commit, rootState}, form){
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: `/api/reset/password`, data: form, method:"POST"})
                .then((resp) => {
                    rootState.message = {
                        type:"success",
                        text:'Mot de passe réinitialisé'
                    };
                    rootState.loading = false;
                    resolve(resp)
                })
                .catch((err) => {
                    let text;
                    if(err.response.data.violations){
                        let violationArray = [];
                        err.response.data.violations.map((violation) => {
                            violationArray.push(violation.message)
                        })
                        text = violationArray.join('\n')
                    }else if(err.response.data.error){
                        text = err.response.data.error
                    }

                    rootState.message = {
                        type:'error',
                        text:text
                    }
                    rootState.loading = false;
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
