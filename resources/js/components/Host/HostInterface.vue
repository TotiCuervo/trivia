<template>
    <div class="pr-3 pl-3" v-if="this.game_code">
        <div class="row pt-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div v-if="game.description">
                            <h3>
                                {{ game.name}}: {{ game.description }}
                            </h3>
                        </div>
                        <div v-else>
                            <h3>
                                {{ game.name }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <h5>Game Code: <u><b>{{this.gameCode.code}}</b></u></h5>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right">
                            <button type="button" class="btn btn-success btn-lg mr-2" @click='goToStartGame()' v-if="currentPage === 'HostLobby'">Start Game</button>
                            <button type="button" class="btn btn-success btn-lg mr-2" @click='goToHostLobby()' v-if="currentPage === 'HostStartGame'">Back</button>

                            <button type="button" class="btn btn-outline-secondary mr-2">
                                <i class="fas fa-edit fa-2x"></i>
                            </button>

                            <button type="button" class="btn btn-outline-danger">
                                <i class="fas fa-door-open fa-2x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <HostLobby
                v-if="currentPage === 'HostLobby'">
        </HostLobby>
        <HostStartGame
                v-if="currentPage === 'HostStartGame'"
                @goToDestination="destinationHandler">
        </HostStartGame>
        <HostRoundPreview
                v-if="currentPage === 'HostRoundPreview'"
                :roundPosition = "this.playRoundPosition"
                @goToDestination="destinationHandler">
        </HostRoundPreview>
        <HostQuestionPreview
                v-if="currentPage === 'HostQuestionPreview'"
                :roundPosition = "this.playRoundPosition"
                :questionPosition="this.playQuestionPosition"
                @goToDestination="destinationHandler">
        </HostQuestionPreview>
        <HostQuestion
                v-if="currentPage === 'HostQuestion'"
                :roundPosition="this.playRoundPosition"
                :questionPosition="this.playQuestionPosition"
                @goToDestination="destinationHandler">
        </HostQuestion>
        <HostRoundReview
            v-if="currentPage === 'HostRoundReview'"
            :roundPosition = "this.playRoundPosition"
            @goToDestination="destinationHandler">
        </HostRoundReview>
        <HostAnswerReveal
            v-if="currentPage === 'HostAnswerReveal'"
            :roundPosition="this.playRoundPosition"
            :questionPosition="this.playQuestionPosition"
            @goToDestination="destinationHandler">
        </HostAnswerReveal>
        <HostLeaderBoard
            v-if="currentPage === 'HostLeaderBoard'"
            :roundPosition="this.playRoundPosition"
            @goToDestination="destinationHandler"
            @gameOver="onGameOver">
        </HostLeaderBoard>

    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                params: '',
                showGame: false,
                currentPage: 'HostLobby',
                playRoundPosition: '',
                playQuestionPosition: '',
            }
        },
        mounted() {
            this.params = this.$route.params;
            this.fetchData(this.params);
            this.fetchRounds(this.params);
            //for Questions
            this.fetchQuestions(this.params.id);

            //for Answers
            this.fetchAnswers(this.params.id);

            //get the game code
            axios.get('/api/game/' + this.params.id + '/gameCode', {
            })
                .then(response => {

                    if (response.data === false) {
                        axios.post('/api/gameCode/' + this.params.id + '/create', {
                        })
                            .then(response => {
                                this.game_code = response.data;
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    } else {
                        // console.log(response.data);
                        this.game_code = response.data[0];
                    }

                })
                .catch(error => {
                    console.log(error);
                });
        },
        methods: {
            ...mapActions('game', ['fetchData']),
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('question', ['fetchQuestions']),
            ...mapActions('answer', ['fetchAnswers']),


            goToStartGame() {
                this.currentPage = 'HostStartGame';
            },
            goToHostLobby() {
                this.currentPage = 'HostLobby';
            },
            destinationHandler(roundPosition, questionPosition, destination) {
                this.playRoundPosition = roundPosition;
                this.playQuestionPosition = questionPosition;
                this.currentPage = destination;
            },

            onStartRoundReview(roundPosition) {
                this.playRoundPosition = roundPosition;
                this.currentPage = 'HostRoundReview';
            },
            onStartAnswerReveal(questionPosition) {
                this.playQuestionPosition = questionPosition;
                this.currentPage = 'HostAnswerReveal';
            },
            onGoToLeaderBoard(roundPosition) {
                this.playRoundPosition = roundPosition;
                this.currentPage = 'HostLeaderBoard';
            },
            onGameOver(){
                console.log('Game Over');
            },


        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('round', ['rounds']),
            game_code: {
                get() {
                    return this.gameCode;
                },
                set(value) {
                    return this.$store.commit('game/SET_GAME_CODE', value);
                }
            }

        }

    }
</script>

<style scoped>

</style>