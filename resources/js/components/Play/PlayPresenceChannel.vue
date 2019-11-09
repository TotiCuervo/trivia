<template>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {}
        },
        mounted() {

            if (this.team.gameCode) {

                Echo.join('game.' + this.loggedTeam.gameCode)
                    .here((users) => {

                    })
                    .listenForWhisper('togglePage', (e) => {

                        console.log('made it to togglePage');
                        console.log('going to ' + e.page);
                        this.playQuestionPosition = e.questionPosition;
                        this.playRoundPosition = e.roundPosition;
                        this.currentPage = e.page;

                    })
                    .listenForWhisper('revealAnswer', (e) => {
                        this.$store.commit('play/UPDATE_REVEAL_ANSWER', true);
                    })
                    .listenForWhisper('catchUp', (e) => {

                        if (this.currentPage !== e.page) {
                            console.log('made it to catchUp!');
                            console.log('going to ' + e.page);

                            this.playQuestionPosition = e.questionPosition;
                            this.playRoundPosition = e.roundPosition;
                            this.currentPage = e.page;

                            if (e.page === 'PlayQuestion') {
                                this.$store.commit('time/UPDATE_TIME_FLAG', true);
                            }
                        }

                    })
                    .listenForWhisper('catchUpTime', (e) => {
                        console.log('made it to catch up time. Time:' + e.time);
                        if (this.catchUpTimeFlag || (this.timer - e.time) >= 3) {
                            console.log('current Page:' + this.page);
                            console.log('made it to catch up time flag. flag:' + this.catchUpTimeFlag);
                            this.$store.commit('time/UPDATE_TIMER', e.time);
                            this.$store.commit('time/UPDATE_TIME_FLAG', false);
                        }
                    })
                    .listenForWhisper('updateLeaderBoard', (e) => {
                        this.$store.commit('team/SET_LEADER_BOARD', e.leaderBoard);
                        console.log('this leaderboard:' + this.leaderBoard)
                    })
                    .listenForWhisper('kickedOut', (e) => {
                        if (e.team.id === this.loggedTeam.id) {
                            // console.log('you were logged off');
                            this.currentPage = '';
                            this.playQuestionPosition = '';
                            this.playRoundPosition = '';
                            this.$router.push({name: "playLogin"});
                        }
                    })
                    .listenForWhisper('newPlayerName', (e) => {
                        if (e.team.id === this.loggedTeam.id) {
                            this.$store.commit('team/SET_NAME', e.newName);
                        }
                    })
                    .listen('UpdatedAnswer', (e) => {
                        if (e.answer.team_id === this.loggedTeam.id) {
                            this.$store.commit('team/UPDATE_TEAM_ANSWER', e.answer);
                        }
                    })
                    // .listen('UpdateTeams', (e) => {
                    //     console.log('Updated Teams:');
                    //     console.log(e.teams);
                    //     this.$store.commit('team/SET_TEAMS', e.teams);
                    //
                    //     if (e.teams.find(x => x.id === this.loggedTeam.id && x.name !== this.loggedTeam.name)) {
                    //         this.loggedTeam = e.teams.find(x => x.id === this.loggedTeam.id);
                    //     }
                    //
                    //     if (!(e.teams.find(x => x.id === this.loggedTeam.id))) {
                    //         // console.log('you were logged off');
                    //         this.currentPage = '';
                    //         this.playQuestionPosition = '';
                    //         this.playRoundPosition = '';
                    //         this.$router.push({name: "playLogin"});
                    //     }
                    //
                    // })
                    .listen('AreYouThere', (e) => {
                        axios.post('/api/team/' + this.team.id + '/iAmHere');
                    });
            }
        },
        created() {

        },
        methods: {
            ...mapActions('game', ['fetchDataByGameCode']),
            ...mapActions('round', ['fetchRoundsByGameCode']),
            ...mapActions('question', ['fetchQuestionsByGameCode']),
            ...mapActions('answer', ['fetchAnswersByGameCode']),
            ...mapActions('team', ['fetchTeamAnswers']),
            ...mapActions('time', ['setUpTimer']),

        },
        computed: {
            ...mapGetters('team', ['team', 'teamAnswers', 'leaderBoard']),
            ...mapGetters('time', ['timer', 'catchUpTimeFlag']),
            ...mapGetters('game', ['game']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page', 'revealAnswer', 'gameCode']),
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
                    this.$store.commit('play/UPDATE_REVEAL_ANSWER', false);
                    // this.revealAnswer = false;
                }
            },
        }
    }
</script>

<style scoped>

</style>
