/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//imports
import VueRouter from 'vue-router'
Vue.use(VueRouter);


import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

import CircularCountDownTimer from "vue-circular-count-down-timer";
Vue.use(CircularCountDownTimer);

Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'




//component names
import EditQAForm from './components/Question/EditQAForm.vue'
import CreateGameName from './components/Game/CreateGameName.vue'
import EditGameName from './components/Game/EditGameName.vue'
import GameDetails from './components/Game/GameDetails.vue'
import GameReview from './components/Game/GameReview.vue'
import CreateQAForm from './components/Question/CreateQAForm.vue'
import HostLobby from './components/Host/HostLobby.vue'
import HostInterface from './components/Host/HostInterface.vue'
import PlayInterface from './components/Play/PlayInterface'
import PlayLogin from './components/Play/PlayLogin.vue'
import PlayLobby from './components/Play/PlayLobby.vue'
import Home from './components/Home.vue'
import  {store} from './store'


// import  {store} from './store'c

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/create/',
            name: 'createGameName',
            component: CreateGameName
        },
        {
            path: '/create/:id/edit',
            name: 'editGameName',
            component: EditGameName
        },
        {
            path: '/game/create/:id',
            name:  'gameDetails',
            component: GameDetails
        },
        {
            path: '/game/details/:id',
            name:  'gameReviewPage',
            component: GameReview
        },
        {
            path: '/host/lobby/:id',
            name:  'hostLobby',
            component: HostLobby
        },
        {
            path: '/host/game/:id',
            name:  'hostInterface',
            component: HostInterface
        },
        {
            path: '/play/goodLuck',
            name:  'playInterface',
            component: PlayInterface
        },
        {
            path: '/play/login',
            name:  'playLogin',
            component: PlayLogin
        },
        {
            path: '/game/:id/round/:round_id/question',
            name:  'createQaForm',
            component: CreateQAForm
        },
        {
            path: '/game/:id/round/:round_id/question/:question_id/edit',
            name:  'editQAForm',
            component: EditQAForm
        },
        { path: '*', redirect: '/home' }
    ]
})

const app = new Vue({
    el: '#app',
    router,
    store
});
