<template>
    <div v-if="this.game_code">
        <HostHeader></HostHeader>

        <div class="pr-3 pl-3 pt-3">
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

        <!--Modals-->
        <b-modal id="leaderBoard" title="Leaderboard" size="lg" hide-footer>
            <LeaderBoardIndex></LeaderBoardIndex>
        </b-modal>

        <b-modal id="gameOutline" title="Game Outline" size="lg" hide-footer>
            <HostGameOutline></HostGameOutline>
        </b-modal>
        <b-modal id="teamList" title="Team List" size="lg" hide-footer>
            <GameTeamIndex :col="8"></GameTeamIndex>
        </b-modal>
        <b-modal id="team" title="Team Profile" size="lg" hide-footer>
            <HostTeamProfile></HostTeamProfile>
        </b-modal>
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