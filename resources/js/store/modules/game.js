function initialState() {
    return {
        trivia: {
            name: null,

            description: null,
            id: null,
            company: null
        },
        loading: false,
        form:{
            name: null,
            user_id: null,
            company: null,
            description: null,
        }
    }
}

const getters = {
    trivia(state){
        return state.trivia;
    },
    name(state){
        return state.trivia.name;
    },
    description(state){
        return state.trivia.description;
    },
    trivia_id(state){
        return state.trivia.id;
    },
    company(state){
        return state.trivia.company;
    },
    formName(state){
        return state.form.name;
    },
    formUser(state){
        return state.form.user_id;
    },
    formCompany(state){
        return state.form.company;
    },
    formDescription(state){
        return state.form.description;
    },
    loading(state){
        return state.loading;
    },
    current(state){
        return state.current;
    },
};

const actions = {
    fetchData({ commit, state }, id) {

        commit('setLoading', true);

        axios.get('/api/trivia/'+id.id)
            .then(response => {
                commit('SET_TRIVIA', response.data);
                commit('setLoading', false);
            })
            .catch( error => {
                console.log(error.response);
            });
    },

};

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
    SET_TRIVIA(state,trivia){
        state.trivia = trivia;
    }

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
