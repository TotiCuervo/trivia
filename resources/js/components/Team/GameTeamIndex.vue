<template>
    <div>
        <div class="row">
            <div class="col-md-4 text-center" v-for="team in this.gameTeams">
                <div class="pb-3">
                    <TriviaTeam :team="team"></TriviaTeam>
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
        methods: {
            deleteTeam($team) {
                this.$store.commit('team/REMOVE_TEAM', $team);
            },
        },
        mounted() {
            Echo.join('game.'+this.game_code.code)
                .here((users) => {
                    axios.get('/api/game/'+this.game_code.code + '/teams')
                        .then(response => {
                            this.$store.commit('team/SET_TEAMS', response.data);
                        });
                })
                .leaving((user) => {
                    console.log('oh wow, someone is leaving and i caught them!');
                    for (let $i=0; $i < this.gameTeams.length; $i++) {
                        axios.get('/api/team/' + this.gameTeams[$i].id + '/pulse')
                            .then(response => {
                                if (response.data === 0) {
                                    vm.$store.commit('team/REMOVE_TEAM', this.gameTeams[$i].team)
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
                    // console.log($add === true);
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

                });
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('team', ['teams']),

            game_code: {
                get() {
                    return this.gameCode;
                },
                set(value) {
                    return this.$store.commit('game/SET_GAME_CODE', value);
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