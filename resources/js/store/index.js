import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);


import user from './modules/user';
import game from './modules/game';
import gameOrder from './modules/gameOrder';
import round from './modules/round';
import question from './modules/question';
import answer from './modules/answer';
import team from './modules/team';




const debug = process.env.NODE_ENV !== 'production';

export const store = new Vuex.Store({
    modules: {
        user,
        game,
        gameOrder,
        round,
        question,
        answer,
        team
    },
    strict: debug
});
