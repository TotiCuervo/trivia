function initialState() {
    return {
        rounds: [],
        roundCount: 0,
        form:{
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
    formData(state){
        return state.form;
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
                commit('SET_ROUND_COUNT');
                commit('UPDATE_ORDER_NUMBER');
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    addRound({commit, state})
    {
        commit('setLoading', true);
        axios.post('api/round', state.form)
            .then(response => {
                commit('setLoading', false);
                commit('CLEAR_FORM');
        }).catch( error => {
            console.log(error.response)
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
    SET_ROUND_COUNT(state){
        state.roundCount = state.rounds.length;
    },
    UPDATE_TITLE(state,title){
        state.form.title = title;
    },
    UPDATE_GAME_ID(state, gameID){
        state.form.game_id = gameID;
    },
    UPDATE_ORDER_NUMBER(state){
        state.form.order_number = state.roundCount + 1;
    },
    UPDATE_ROUND_TYPE(state, round_type){
        state.form.round_type = round_type;
    },
    CLEAR_FORM(state){
        state.form = {
            title: null,
            game_id: null,
            order_number: null,
            round_type:null,
        };
    },

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
