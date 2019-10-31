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

    sendPlayersPage({ commit, state }, page) {

        Echo.join('game.'+ state.gameCode.code).whisper("togglePage", {
            roundPosition: state.roundPosition,
            questionPosition: state.questionPosition,
            page: page
        });

    },

    revealAnswerToPlayers({ commit, state }) {
        Echo.join('game.'+ state.gameCode.code).whisper("revealAnswer", {});
    },

    catchTeamUp({ commit, state }) {
        console.log('in catchTeamUp');
        let $catchUpPage = '';

        switch (state.page) {
            case 'HostRoundReview':
                $catchUpPage = 'PlayRoundReview';
                break;
            case 'HostRoundPreview':
                $catchUpPage = 'PlayRoundPreview';
                break;
            case 'HostLeaderBoard':
                $catchUpPage = 'PlayLeaderBoard';
                break;
            case 'HostQuestion':
                $catchUpPage = 'PlayQuestion';
                break;
            default:
                $catchUpPage = '';
        }

        if (state.page !== 'HostLobby') {
            Echo.join('game.'+ state.gameCode.code).whisper("catchUp", {
                roundPosition: state.roundPosition,
                questionPosition: state.questionPosition,
                page: $catchUpPage
            });
        }

        //conditions functions
        if ($catchUpPage === 'PlayQuestion') {
            console.log('sending time');
            Echo.join('game.'+ state.gameCode.code).whisper("catchUpTime", {
                time: state.timer
            });
        }

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
        state.revealAnswer = revealAnswer;
    },
    UPDATE_TIMER(state, time) {
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
