<template>
    <div>
        <div class="row pt-1 pb-3">
            <div class="col-md-12 text-center">
                <h3>Teams:</h3>
            </div>
        </div>
        <div class="row pt-3">
            <div class="text-center" v-bind:class="{'col-md-3': col === 3 || team.name.length < 17 , 'col-md-8 offset-md-2': col === 8}" v-for="team in this.gameTeams">
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
        },
        props: ['col'],
    }
</script>

<style scoped>

</style>
