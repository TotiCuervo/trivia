function initialState() {
    return {
        rounds: [],
        roundCount: 0,
        form: {
            title: null,
            time: null,
            round_type: null,
            game_id: null,
            order_number:null,
        }
    }
}

const getters = {
    rounds(state){
        return state.rounds;
    },
    roundCount(state){
        return state.roundCount;
    },
    formTitle(state){
        return state.form.title;
    },
    formGameID(state){
        return state.form.game_id;
    },
    formOrderNumber(state){
        return state.form.order_number;
    },
    formRoundType(state){
        return state.form.round_type;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {
    fetchRounds({ commit, state }, id) {

        commit('setLoading', true);

        axios.get('/api/trivia/'+id.id+'/rounds')
            .then(response => {
                commit('SET_ROUNDS', response.data);
                commit('SET_ROUNDCOUNT');
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
    SET_ROUNDS(state,rounds){
        state.rounds = rounds;
    },
    SET_ROUNDCOUNT(state){
        state.roundCount = state.rounds.length;
    },
    UPDATE_TITLE(state,title){
        state.form.title = title;
    },
    UPDATE_GAME_ID(state, gameID){
        state.form.game_id = gameID;
    },
    UPDATE_ORDER_NUMBER(state, orderNumber){
        state.form.order_number = orderNumber;
    },
    UPDATE_ROUND_TYPE(state, round_type){
        state.form.round_type = round_type;
    },

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
