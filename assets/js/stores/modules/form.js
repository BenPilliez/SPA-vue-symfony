import axios from "axios";


const state = () => ({
})

const mutations = {

}

const getters = {
}

const actions = {

    send({commit, rootState}, {form, url}) {
        rootState.loading = true;
        return new Promise((resolve, reject) => {
            axios({url: url, data: form, method: form.method})
                .then((resp) => {

                    rootState.message = {
                        type: 'success',
                        text: 'Ton profile a été mis à jour'
                    };

                    rootState.loading = false;
                    localStorage.setItem('user', JSON.stringify(resp.data));
                    resolve(resp);

                })
                .catch((err) => {
                    let violationArray = [];
                    let text;
                    if (err.response.data.violations) {
                        err.response.data.violations.map((violation) => {
                            violationArray.push(violation.message);
                        })
                        text = violationArray.join('\n');
                    } else if (err.response.data.error) {
                        text = err.response.data.error;
                    } else {
                        text = 'Oops on a eu problème Houston'
                    }

                    rootState.loading = false;
                    rootState.message = {
                        type: "error",
                        text: text
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
