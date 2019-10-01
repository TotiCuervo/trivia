<template>
<!--    <div class="host-header">-->
<!--        <div class="pr-3 pl-3">-->
<!--            <div class="row pt-3">-->
<!--                <div class="col-md-12">-->
<!--                    <span class="fa-stack fa-1 fa-gray-white clicker float-right pr-2"-->
<!--                      style="vertical-align: top;"-->
<!--                      v-b-tooltip.bottom title="Leaderboard"-->
<!--                      v-b-modal.leaderBoard>-->
<!--                      <i class="far fa-circle fa-stack-2x"></i>-->
<!--                      <i class="fas fa-trophy fa-stack-1x"></i>-->
<!--                    </span>-->
<!--                    <span class="fa-stack fa-1 fa-gray-white clicker float-right pr-2"-->
<!--                          style="vertical-align: top;"-->
<!--                          v-b-tooltip.bottom title="Game Outline"-->
<!--                          v-b-modal.gameOutline>-->
<!--                      <i class="far fa-circle fa-stack-2x"></i>-->
<!--                      <i class="fas fa-list-ol fa-stack-1x"></i>-->
<!--                    </span>-->
<!--                    <span class="fa-stack fa-1 fa-gray-white clicker float-right pr-2"-->
<!--                          style="vertical-align: top;"-->
<!--                          v-b-tooltip.bottom title="Team List"-->
<!--                          v-b-modal.teamList>-->
<!--                      <i class="far fa-circle fa-stack-2x"></i>-->
<!--                      <i class="fas fa-user-friends fa-stack-1x"></i>-->
<!--                    </span>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row pt-3">-->
<!--                <div class="col-12 text-center">-->
<!--                    <div v-if="game.description">-->
<!--                        <h3 class="d-inline-block">-->
<!--                            {{ game.name}}: {{ game.description }}-->
<!--                        </h3>-->
<!--                    </div>-->
<!--                    <div v-else>-->
<!--                        <h3 class="d-inline-block">-->
<!--                            {{ game.name }}-->
<!--                        </h3>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col-12 text-center">-->
<!--                    <h5 v-if="game.company">-->
<!--                        {{game.company}}-->
<!--                    </h5>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row pb-3">-->
<!--                <div class="col-12 text-center">-->
<!--                    <h5>Game Code: <u><b>{{this.gameCode.code}}</b></u></h5>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="host-header">
        <div class="pr-3 pl-3">
            <div class="row pt-3 pb-3">
                <div class="col-12 col-md-5 order-2 text-center text-md-left">
                    <p class="mb-0 mt-1" v-if="game.description && game.company">{{game.name}}: {{game.description}} @ {{game.company}}</p>
                    <p class="mb-0 mt-1" v-else-if="game.description">{{game.name}}: {{game.description}}</p>
                    <p class="mb-0 mt-1" v-else>{{game.name}}</p>
                </div>
                <div class="col-12 col-md-3 order-3 order-md-2 text-center text-md-left">
                    <p class="mb-0 mt-1">Game Code: <u><b>{{this.gameCode.code}}</b></u></p>
                </div>
                <div class="col-4 offset-8 offset-md-0 order-1 order-md-3">
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
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                acceptablePages: ['HostRoundPreview', 'HostRoundReview', 'HostLeaderBoard'],
            }
        },
        mounted() {

            Echo.join('game.'+this.gameCode.code)
                .here((users) => {

                    //Gets all the Teams
                    axios.get('/api/game/'+this.gameCode.code + '/teams')
                        .then(response => {
                            this.$store.commit('team/SET_TEAMS', response.data);
                        });

                    //Gets all the Answers
                    axios.get('/api/game/' + this.gameCode.code + '/teamAnswers')
                        .then(response => {
                            this.$store.commit('team/SET_TEAM_ANSWERS', response.data);
                        });
                })
                .leaving((user) => {

                    //sets all teams to not logged in and sends request to log back in;
                    axios.post('/api/host/game/'+this.gameCode.code+'/areYouThere');

                    //Gets all the Teams
                    let vm = this;
                    setTimeout(function () {
                        axios.get('/api/game/'+vm.gameCode.code + '/teams')
                            .then(response => {
                                vm.$store.commit('team/SET_TEAMS', response.data);
                            });
                    }, 5000);

                })
                .listen('NewTeam', (e) => {
                    // console.log('made it in new team');

                    //sets the add equal to true
                    let $add = true;

                    //loops through the teams in the game
                    for (let $i=0; $i < this.gameTeams.length; $i++) {

                        //if the team is in the list of current teams
                        if (this.gameTeams[$i].name === e.team.name) {

                            //if this team is not logged in on our list, update it so it shows they are online
                            if (!this.gameTeams[$i].loggedIn) {
                                this.$store.commit('team/UPDATE_TEAM', e.team);
                            }

                            //make it so that this team does not get added twice
                            $add = false;
                        }
                    }

                    //if this team is new, add them
                    if ($add === true) {
                        this.gameTeams = e.team;

                        if (this.currentPage !== 'HostLobby') {
                            this.newPlayerToast(e.team);
                        }
                    }

                    this.catchUpTeam(e.team);

                })
                .listen('TeamLeaving', (e) => {
                    console.log('someone is leaving the game');

                    //for now
                    // this.$store.commit('team/REMOVE_TEAM', e.team)






                //    Old Code:

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

                })
                .listen('NewTeamAnswer', (e) => {
                    this.$store.commit('team/ADD_TEAM_ANSWER', e.teamAnswer);
                })
        },
        methods: {
            goToStartGame() {
                this.currentPage = 'HostStartGame';
            },
            goToHostLobby() {
                this.currentPage = 'HostLobby';
            },
            catchUpTeam(team) {
            // this is used to catch up a new user if they logged in

                if (this.acceptablePages.find(x => x === this.currentPage)) {

                    let $playerPage = '';

                    switch (this.currentPage) {
                        case 'HostRoundReview':
                            $playerPage = 'PlayRoundReview';
                            break;
                        case 'HostRoundPreview':
                            $playerPage = 'PlayRoundPreview';
                            break;
                        case 'HostLeaderBoard':
                            $playerPage = 'PlayLeaderBoard';
                            break;
                    }

                    console.log('made it to catchUpTeam. Sending:');
                    console.log($playerPage);

                    axios.post('/api/host/'+ this.gameCode.code + '/round/' + this.playRoundPosition +'/question/' + this.playQuestionPosition + '/currentPage/' + $playerPage);

                    if ($playerPage === 'PlayLeaderBoard') {
                        axios.post('/api/team/'+ this.gameCode.code +'/leaderBoard');
                    }

                }

            },
            newPlayerToast(team) {
                this.$bvToast.toast(`${team.name} has joined the game!`, {
                    title: `New Player!`,
                    variant: 'info',
                    solid: true
                })
            }
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
