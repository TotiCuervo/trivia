function initialState() {
    return {
        timer: 2,
        max: 0,
        variantColor: 'success',
        yellowTime: '',
        redTime: '',
        catchUpTimeFlag: false,
        loading: false
    }
}

const getters = {
    timer(state) {
        return state.timer;
    },
    max(state) {
        return state.max;
    },
    variantColor(state) {
        return state.variantColor;
    },
    yellowTime(state) {
        return state.yellowTime;
    },
    redTime(state) {
        return state.redTime;
    },
    catchUpTimeFlag(state) {
        return state.catchUpTimeFlag;
    }
};

const actions = {

    sendPlayersPage({ commit, state }, page) {
        console.log('in sending players page. Sending: ' + page);
        Echo.join('game.'+ state.gameCode.code).whisper("togglePage", {
            roundPosition: state.roundPosition,
            questionPosition: state.questionPosition,
            page: page
        });

    },

    setUpTimer({ commit, state }, time) {
        commit('SET_MAX', time);
        commit('SET_YELLOW_TIME', (time/3) * 2);
        commit('SET_RED_TIME', (time/3));
    }

};

const mutations = {
    SET_LOADING(state, loading) {
        state.loading = loading
    },
    UPDATE_TIMER(state, time) {
        state.timer = time;
    },
    SET_MAX(state, max) {
        state.max = max;
    },
    SET_VARIANT_COLOR(state, color) {
        state.variantColor = color;
    },
    SET_YELLOW_TIME(state, time) {
        state.yellowTime = time;
    },
    SET_RED_TIME(state, time) {
        state.redTime = time;
    },
    UPDATE_TIME_FLAG(state, flag) {
        state.catchUpTimeFlag = flag;
    }
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
