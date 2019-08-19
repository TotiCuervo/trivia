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
                v-if="currentPage === 'HostStartGame'">
        </HostStartGame>
        <HostRoundPreview
                v-if="currentPage === 'HostRoundPreview'">
        </HostRoundPreview>
        <HostQuestionPreview
                v-if="currentPage === 'HostQuestionPreview'">
        </HostQuestionPreview>
        <HostQuestion
                v-if="currentPage === 'HostQuestion'">
        </HostQuestion>
        <HostRoundReview
            v-if="currentPage === 'HostRoundReview'">
        </HostRoundReview>
        <HostAnswerReveal
            v-if="currentPage === 'HostAnswerReveal'">
        </HostAnswerReveal>
        <HostLeaderBoard
            v-if="currentPage === 'HostLeaderBoard'"
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

            this.currentPage = 'HostLobby';
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
            onGameOver(){
                console.log('Game Over');
            },
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            game_code: {
                get() {
                    return this.gameCode;
                },
                set(value) {
                    return this.$store.commit('game/SET_GAME_CODE', value);
                }
            },
            playRoundPosition: {
                get() {
                    return this.roundPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_ROUND_POSITION', value);
                }
            },
            playQuestionPosition: {
                get() {
                    return this.questionPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_QUESTION_POSITION', value);
                }
            },
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            }

        }

    }
</script>

<style scoped>

</style>