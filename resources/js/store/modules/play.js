function initialState() {
    return {
        darkMode: true,
        roundPosition: 0,
        questionPosition: 0,
        page: '',
        gameCode: '',
        revealAnswer: false,
        timer: 2,
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
    gameCode(state) {
        return state.gameCode;
    },
    loading(state){
        return state.loading;
    },
    darkMode(state) {
        return state.darkMode;
    },
    revealAnswer(state) {
        return state.revealAnswer;
    },
    timer(state) {
        return state.timer;
    }
};

const actions = {


    sendAnswerToHost({commit, state}, answer) {

    }

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
    },
    SET_GAME_CODE(state, gameCode) {
        state.gameCode = gameCode;
    },
    UPDATE_REVEAL_ANSWER(state, revealAnswer) {
        console.log('made it to reveal answer update');
        state.revealAnswer = revealAnswer;
    },
    UPDATE_TIMER(state, time) {
        // console.log('getting time:' + time);
        state.timer = time;
    }
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
