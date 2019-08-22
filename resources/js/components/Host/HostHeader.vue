<template>
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
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {

            }
        },
        mounted() {
            Echo.join('game.'+this.gameCode.code)
                .here((users) => {
                    axios.get('/api/game/'+this.gameCode.code + '/teams')
                        .then(response => {
                            this.$store.commit('team/SET_TEAMS', response.data);
                        });

                    axios.get('/api/game/' + this.gameCode.code + '/teamAnswers')
                        .then(response => {
                            this.$store.commit('team/SET_TEAM_ANSWERS', response.data);
                        });
                })
                .leaving((user) => {
                    console.log('oh wow, someone is leaving and i caught them!');
                    for (let $i=0; $i < this.gameTeams.length; $i++) {
                        axios.get('/api/team/' + this.gameTeams[$i].id + '/pulse')
                            .then(response => {
                                if (response.data === 0) {
                                    this.$store.commit('team/REMOVE_TEAM', this.gameTeams[$i].team)
                                }
                            });
                    }
                })
                .listen('NewTeam', (e) => {
                    // console.log('made it in new team');
                    let $add = true;

                    for (let $i=0; $i < this.gameTeams.length; $i++) {
                        if (this.gameTeams[$i].name === e.team.name) {
                            $add = false;
                        }
                    }
                    if ($add === true) {
                        // console.log(e);
                        this.gameTeams = e.team;
                    }

                })
                .listen('TeamLeaving', (e) => {
                    console.log('someone is leaving the game');
                    // let vm = this;
                    // setTimeout(function () {
                    //     axios.get('/api/team/'+ e.team.id + '/pulse')
                    //         .then(response => {
                    //             // console.log(response.data);
                    //             if (response.data === 0) {
                    //                 vm.$store.commit('team/REMOVE_TEAM', e.team)
                    //             }
                    //         });
                    // }, 2000);

                    this.$store.commit('team/REMOVE_TEAM', e.team)

                })
                .listen('NewTeamAnswer', (e) => {
                    this.$store.commit('team/ADD_TEAM_ANSWER', e.teamAnswer);
                });
        },
        methods: {
            goToStartGame() {
                this.currentPage = 'HostStartGame';
            },
            goToHostLobby() {
                this.currentPage = 'HostLobby';
            },
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            ...mapGetters('team', ['teams', 'teamAnswers']),
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
            },
            gameTeams: {
                get() {
                    return this.teams;
                },
                set(value) {
                    return this.$store.commit('team/ADD_TEAM', value);
                }
            }

        }
    }
</script>

<style scoped>

</style>