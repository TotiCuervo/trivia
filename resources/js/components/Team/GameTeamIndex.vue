<template>
    <div>
        <div class="row pb-3">
            <div class="col-md-12 text-center">
                <h3>This Trivia game can be joined using this code: <u><b>{{this.gameCode.code}}</b></u></h3>
            </div>
        </div>
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

        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('team', ['teams']),
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