<template>
    <div>
        <TeamPlayHeader></TeamPlayHeader>
        <div>
            <div class="container">
                <PlayHomeScreen
                        v-if="this.game.name !== '' && this.currentPage === ''">
                </PlayHomeScreen>
                <PlayRoundPreview
                        v-if="this.currentPage === 'PlayRoundPreview'">
                </PlayRoundPreview>
                <PlayRoundReview
                        v-if="this.currentPage === 'PlayRoundReview'">
                </PlayRoundReview>
                <PlayRevealAnswer
                        v-if="this.currentPage === 'PlayRevealAnswer'"
                        :revealAnswer = revealAnswer>
                </PlayRevealAnswer>
                <PlayLeaderBoard
                        v-if="this.currentPage === 'PlayLeaderBoard'">
                </PlayLeaderBoard>
            </div>
            <PlayQuestion
                    v-if="this.currentPage === 'PlayQuestion'">
            </PlayQuestion>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                revealAnswer: false
            }
        },
        mounted() {

            if(this.team.gameCode) {
                this.fetchDataByGameCode(this.team.gameCode);
                this.fetchRoundsByGameCode(this.team.gameCode);
                this.fetchQuestionsByGameCode(this.team.gameCode);
                this.fetchAnswersByGameCode(this.team.gameCode);
                this.fetchTeamAnswers(this.team.id);


                Echo.join('game.' + this.loggedTeam.gameCode)
                    .listen('NextStep', (e) => {
                        console.log('got the page');
                        console.log(e);
                        this.playRoundPosition = e.roundPosition;
                        this.playQuestionPosition = e.questionPosition;
                        this.currentPage = e.currentPage;
                    })
                    .listen('RevealAnswer', (e) => {
                        // console.log('time to show answer');
                        this.revealAnswer = true;
                    })
                    .listen('UpdatedAnswer', (e) => {
                        if (e.answer.team_id === this.loggedTeam.id) {
                            this.$store.commit('team/UPDATE_TEAM_ANSWER', e.answer);
                        }
                    })
                    .listen('UpdateTeams', (e) => {
                        console.log('Updated Teams:');
                        console.log(e.teams);
                        this.$store.commit('team/SET_TEAMS', e.teams);

                        if (e.teams.find(x => x.id === this.loggedTeam.id && x.name !== this.loggedTeam.name)) {
                            this.loggedTeam = e.teams.find(x => x.id === this.loggedTeam.id);
                        }

                        if (!(e.teams.find(x => x.id === this.loggedTeam.id))) {
                            console.log('you were logged off');
                            this.currentPage = '';
                            this.playQuestionPosition = '';
                            this.playRoundPosition = '';
                            this.$router.push({name: "playLogin"});
                        }

                    })
                    .listen('AreYouThere', (e) => {
                        console.log("I am here");
                        axios.post('/api/team/' + this.team.id + '/iAmHere');
                    });
            }
        },
        created() {
            window.addEventListener('beforeunload', this.leaving);
        },
        methods: {
            ...mapActions('game', ['fetchDataByGameCode']),
            ...mapActions('round', ['fetchRoundsByGameCode']),
            ...mapActions('question', ['fetchQuestionsByGameCode']),
            ...mapActions('answer', ['fetchAnswersByGameCode']),
            ...mapActions('team', ['fetchTeamAnswers']),

            logout(){
                localStorage.removeItem('user-token');
                this.$store.commit('team/CLEAR_FORM');
                this.$router.push({name: "playLogin"});
            },
            leaving() {
                axios.post('/api/team/logout/'+ this.loggedTeam.id)
                    .then(response => {

                    });
            },
        },
        computed: {
            ...mapGetters('team', ['team', 'teamAnswers']),
            ...mapGetters('game', ['game']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            loggedTeam: {
                get() {
                    return this.team;
                },
                set(value) {
                    return this.$store.commit('team/SET_TEAM', value);
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

        },
        watch: {
            questionPosition: function () {
                if (this.revealAnswer === true) {
                    this.revealAnswer = false;
                    document.querySelector('body').style.backgroundColor = 'white';
                }
            },
        }
    }
</script>

<style scoped>

</style>