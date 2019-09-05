<template>
    <div class="host-header">
        <div class="pr-3 pl-3">
            <div class="row pt-3">
                <div class="col-md-12">
                    <span class="fa-stack fa-1 fa-gray-white clicker float-right pr-2"
                      style="vertical-align: top;"
                      v-b-tooltip.bottom title="Leaderboard"
                      v-b-modal.leaderBoard>
                      <i class="far fa-circle fa-stack-2x"></i>
                      <i class="fas fa-trophy fa-stack-1x"></i>
                    </span>
                    <span class="fa-stack fa-1 fa-gray-white clicker float-right pr-2"
                          style="vertical-align: top;"
                          v-b-tooltip.bottom title="Game Outline"
                          v-b-modal.gameOutline>
                      <i class="far fa-circle fa-stack-2x"></i>
                      <i class="fas fa-list-ol fa-stack-1x"></i>
                    </span>
                    <span class="fa-stack fa-1 fa-gray-white clicker float-right pr-2"
                          style="vertical-align: top;"
                          v-b-tooltip.bottom title="Team List"
                          v-b-modal.teamList>
                      <i class="far fa-circle fa-stack-2x"></i>
                      <i class="fas fa-user-friends fa-stack-1x"></i>
                    </span>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-12 text-center">
                    <div v-if="game.description">
                        <h3 class="d-inline-block">
                            {{ game.name}}: {{ game.description }}
                        </h3>
                    </div>
                    <div v-else>
                        <h3 class="d-inline-block">
                            {{ game.name }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <h5 v-if="game.company">
                        {{game.company}}
                    </h5>
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-12 text-center">
                    <h5>Game Code: <u><b>{{this.gameCode.code}}</b></u></h5>
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
                })
                .listen('UpdateTeams', (e) => {
                    console.log(e);
                    this.$store.commit('team/SET_TEAMS', e.teams);
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