<template>
    <div class="trivalo-card card">
        <div class="card-body">
            <div class="row">
                <div class="col-9 pr-0">
                    <button type="button" style="margin-left: -40px" class="btn btn-primary btn-circle btn-lg" v-b-tooltip.left title="Play Game" @click="playGame()">
                        <i class="fas fa-play"></i>
                    </button>
                    <span class="pl-3">
                        <span class="h6"><span class="font-weight-normal">{{this.game.name}}</span><span class="font-weight-normal" v-if="this.game.description">: {{this.game.description}}</span> <span v-if="this.game.company"> @ {{this.game.company}}</span> </span>
                    </span>
                </div>
                <div class="col-3 pl-0">
                    <div class="float-right">
                        <router-link :to="{ name: 'gameDetails', params: {id: game.id} }">
                            <button type="button" class="btn btn-outline-primary">Edit</button>
                        </router-link>

                        <b-dropdown variant="link" toggle-class="text-decoration-none p-0" no-caret id="dropdown-right" right >
                            <template v-slot:button-content>
                                <span class="align-middle ml-3 color-black"><i class="fas fa-ellipsis-v" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i></span>
                            </template>
                            <b-dropdown-item href="#">
                                    <span class="fa-1x clicker" v-b-modal.delete-game @click="setGame()">
                                        <span class="pr-2"><i class="fas fa-trash-alt"></i></span> Delete Game
                                    </span>
                            </b-dropdown-item>
                            <b-dropdown-item href="#">
                                    <span class="fa-1x clicker" @click="copyGame()">
                                        <span class="pr-2"><i class="fas fa-clone"></i></span> Copy Game
                                    </span>
                            </b-dropdown-item>
                        </b-dropdown>


                    </div>
                </div>
            </div>
        </div>
    </div>

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
