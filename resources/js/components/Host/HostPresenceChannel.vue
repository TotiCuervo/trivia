<template>

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
            //Presence Channel
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
                    console.log('someone is leaving');
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
                .listen('WhereAreWe', (e) => {
                    this.catchUpTeam(e.team);
                });

        },
        methods: {
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
                    console.log('To Player:');
                    console.log(team.name);

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
