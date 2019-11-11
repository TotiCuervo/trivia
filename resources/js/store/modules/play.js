function initialState() {
    return {
        darkMode: true,
        roundPosition: 0,
        questionPosition: 0,
        page: '',
        gameCode: '',
        revealAnswer: false,
        timer: 2,
        loggedIn: false,
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
    loggedIn(state) {
        return state.loggedIn;
    },
    timer(state) {
        return state.timer;
    }
};

const actions = {



    sendAnswerToHost({commit, state}, answer) {

    },
    attemptLogin({commit, state}, playload) {

        console.log('made it in attemptLogin');

        //makes team to send to server
        let $attemptTeam = {
            name: playload.team.name,
            gameCode: playload.team.gameCode,
            password: playload.team.password,
            identifier: playload.team.name+playload.team.gameCode,
            provider: 'teams'
        };

        //checks to see if the player is registered or logged in
        axios.post('/api/team/lazyLogin', $attemptTeam)
            .then(response => {
                console.log('response: '+response.data);

                //if it is unauthorized or logged in, give them the boot
                if (response.data === ('unauthorized' || 'alreadyLoggedIn')) {
                    this.state.currentPage = '';
                    this.state.questionPosition = '';
                    this.state.roundPosition = '';
                    commit('SET_LOGGED_IN', true);
                    window.location.reload();
                }
                //else, log them into the game
                else {
                    commit('SET_LOGGED_IN', true)
                }

            });
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
    SET_LOGGED_IN(state, loggedIn) {
        state.loggedIn = loggedIn;
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
