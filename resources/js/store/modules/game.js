function initialState() {
    return {
        game: {
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
    game(state){
        return state.game;
    },
    name(state){
        return state.game.name;
    },
    description(state){
        return state.game.description;
    },
    game_id(state){
        return state.game.id;
    },
    company(state){
        return state.game.company;
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

        axios.get('/api/game/'+id.id)
            .then(response => {
                commit('SET_GAME', response.data);
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
    SET_GAME(state, game){
        state.game = game;
    }

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
