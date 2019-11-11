import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);


import user from './modules/user';
import game from './modules/game';
import round from './modules/round';
import question from './modules/question';
import answer from './modules/answer';
import team from './modules/team';
import play from './modules/play';
import host from './modules/host';
import time from './modules/time';






const debug = process.env.NODE_ENV !== 'production';

export const store = new Vuex.Store({
    modules: {
        user,
        game,
        round,
        question,
        answer,
        team,
        play,
        time,
        host
    },
    strict: debug
});
