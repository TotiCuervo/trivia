<template>
    <div>
        <div v-for="team in this.gameTeams">
            <TriviaTeam :team="team"></TriviaTeam>
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
            Echo.join('game.'+this.game_code.code)
                .here((users) => {
                    axios.get('/api/game/'+this.game_code.code + '/teams')
                        .then(response => {
                            this.$store.commit('team/SET_TEAMS', response.data);
                        });
                })
                .listen('NewTeam', (e) => {

                    let $add = true;

                    for (let $i=0; $i < this.gameTeams.length; $i++) {
                        if (this.gameTeams[$i].name === e.name) {
                            $add = false;
                        }
                    }

                    if ($add = true) {
                        // console.log(e);
                        this.gameTeams = e.team;
                    }

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