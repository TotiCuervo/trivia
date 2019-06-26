function initialState() {
    return {
        gameOrder: 'Loading...',
        rounds: [],
        breaks: [],
    }
}

const getters = {
    gameOrder(state){
        return state.gameOrder;
    },
    rounds(state){
        return state.rounds;
    },
    breaks(state){
        return state.breaks;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {
    fetchData({ commit, state }, trivia_id) {

        commit('setLoading', true);

        console.log('made it');

        axios.get('/api/gameOrder'+trivia_id)
            .then(response => {
                commit('SET_GAMEORDER', response.data);
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

};

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
    SET_GAMEORDER(state,data){
        state.user = user;
    }

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
