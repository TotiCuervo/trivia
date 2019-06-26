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


//component names
import CreateTrivia from './components/Game/CreateTrivia.vue'
import ShowGame from './components/Game/Show.vue'
import CreateRound from './components/Round/CreateRound.vue'
import  {store} from './store'

// import  {store} from './store'

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const router = new VueRouter({
    routes: [
        {
            path: '/create/',
            name: 'createTrivia',
            component: CreateTrivia
        },
        {
            path: '/trivia/:id',
            name:  'showGame',
            component: ShowGame
        },
        {
            path: '/trivia/:id/round',
            name:  'createRound',
            component: CreateRound
        }
    ]
})

const app = new Vue({
    el: '#app',
    router,
    store
});
