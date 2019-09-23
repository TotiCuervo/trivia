<template>

    <div class="trivalo-card card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <span class="fa-1x float-right first-gray then-black trans-1 clicker" v-b-tooltip.top title="Delete Game" v-b-modal.delete-game @click="setGame()">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                    <span class="fa-1x float-right first-gray then-black trans-1 pr-2 clicker" v-b-tooltip.top title="Copy Game" @click="copyGame()">
                        <i class="fas fa-clone"></i>
                    </span>
                </div>
            </div>
            <div class="container">
                <router-link :to="{ name: 'gameDetails', params: {id: game.id} }" style="text-decoration:none; color:black;">
                    <div class="row pb-2">
                        <div class="col-md-12 text-center">
                            <div class="circle-text mx-auto no-dec" v-bind:class="game.headClass">{{this.name}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">

                            <p class="m-0">{{game.name}}</p>
                            <small v-if="game.description">{{game.description}}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <small class="text-muted" v-if="game.company">{{game.company}}</small>
                        </div>
                    </div>
                </router-link>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col p-1 text-center">
                        <!--opens in different tab-->
                        <b-button block pill variant="outline-primary" @click="playGame()">Edit</b-button>
                    </div>
                    <div class="col p-1 text-center">
                        <!--opens in different tab-->
                        <b-button block pill variant="primary" @click="playGame()">Play</b-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<router-link :to="{ name: 'gameDetails', params: {id: game.id} }" class="nav-link">-->

</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                name: ''
            }
        },
        mounted() {

            this.name = this.game.name[0];

            for (let $i = 0; $i < this.game.name.length; $i++) {
                if (this.name.length >= 3) {
                    $i = this.game.name.length;
                }
                else {
                    if (this.game.name[$i] === ' ') {
                        this.name = this.name + this.game.name[$i + 1];
                    }
                }
            }

        },
        methods: {
            ...mapActions('game', ['newGame']),
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('question', ['fetchQuestions']),
            ...mapActions('answer', ['fetchAnswers']),

            setGame() {
                this.$store.commit('game/SET_GAME', this.game);
            },
            copyGame() {

                this.$store.commit('game/SET_GAME', this.game);

                this.fetchRounds(this.game);
                this.fetchQuestions(this.game.id);
                this.fetchAnswers(this.game.id);

                //New Game
                axios.post('/api/game/create', this.game)
                    .then(response => {
                        let $newGame = response.data;

                        for (let $i = 0; $i < this.rounds.length; $i++) {

                            let $newRound = {
                                title: this.rounds[$i].title,
                                time: this.rounds[$i].time,
                                round_type: this.rounds[$i].round_type,
                                game_id: $newGame.id,
                                order_number: this.rounds[$i].order_number,
                            };

                            //New Rounds
                            axios.post('api/round/create', $newRound)
                                .then(response => {

                                    let $brandNewRound = response.data;

                                    for (let $b = 0; $b < this.questions.length; $b++) {

                                        if (this.questions[$b].round_id === this.rounds[$i].id) {

                                            let $newQuestion = {
                                                title: this.questions[$b].title,
                                                type: this.questions[$b].type,
                                                round_id: $brandNewRound.id,
                                                order_number: this.questions[$b].order_number,
                                            };

                                            //New Questions
                                            axios.post('/api/question/create', $newQuestion)
                                                .then(response => {

                                                    let $brandNewQuestion = response.data;

                                                    for (let $c = 0; $c < this.answers.length; $c++) {

                                                        if (this.answers[$c].question_id === this.questions[$b].id) {

                                                            let $newAnswer = {
                                                                title: this.answers[$c].title,
                                                                question_id: $brandNewQuestion.id,
                                                                round_id: $brandNewQuestion.round_id,
                                                                correct: this.answers[$c].correct,
                                                            };

                                                            //New Answers
                                                            axios.post('/api/answer/create', $newAnswer)
                                                                .then(response => {

                                                                }).catch(error => {
                                                                console.log(error.response);
                                                            });
                                                        }
                                                        ;
                                                    }
                                                    ;

                                                }).catch(error => {
                                                console.log(error.response);
                                            });
                                        }

                                    }

                                }).catch(error => {
                                console.log(error.response)
                            });
                        }

                        this.$router.push({name: "editGameName", params: {id: $newGame.id}});

                        // // this.createGameOrder(game.id);
                        // this.$store.commit('round/UPDATE_GAME_ID', $game.id);
                        //
                        // this.addRound();
                        //
                        // this.$router.push({ name: "gameDetails", params: { id: $game.id }});

                    });
            },
            playGame() {
                //may need to change for production
                let route = "app#/host/game/" + this.game.id;

                window.open(route, "_blank");
            }
        },
        props: ['game'],
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),


        },
    }
</script>

<style scoped>

</style>
