function initialState() {
    return {
        roundPosition: 0,
        questionPosition: 0,
        page: '',
        //make myAnswers into an array when ready to implement
        myAnswers: 'This is my Answer!',
        loading: false
    }
}

const getters = {
    roundPosition(state) {
        return state.roundPosition;
    },
    questionPosition(state) {
        return state.questionPosition;
    },
    page(state) {
        return state.page;
    },
    myAnswers(state) {
        return state.myAnswers;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {


};

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
    SET_ROUND_POSITION(state,roundPosition) {
        state.roundPosition = roundPosition;
    },
    SET_QUESTION_POSITION(state, questionPosition) {
        state.questionPosition = questionPosition;
    },
    SET_PAGE(state, page) {
        state.page = page;
    }
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
