<template>
    <div>
        <div class="row pb-3">
            <div class="col-md-12 text-center">
                <h3>This Trivia game can be joined using this code: <u><b>{{this.gameCode.code}}</b></u></h3>
            </div>
        </div>
        <div class="row">
            <div class="text-center" v-bind:class="{'col-md-3': col === 3 || team.name.length < 17 , 'col-md-8 offset-md-2': col === 8}" v-for="team in this.gameTeams">
                <div class="pb-3">
                    <TriviaTeam :team="team"></TriviaTeam>
                </div>
            </div>

            <!--Option 1-->
            <!--<div class="text-center" v-for="team in this.gameTeams">-->
                <!--<div class="pb-3 pr-2 pl-2">-->
                    <!--<TriviaTeam :team="team"></TriviaTeam>-->
                <!--</div>-->
            <!--</div>-->

            <!--<div class="text-center" v-bind:class="{'col-md-3': team.name.length <= 13,'col-md-4': team.name.length > 13 && team.name.length <= 17 , 'col-md-5': team.name.length >= 18}" v-for="team in this.gameTeams">-->
                <!--<div class="pb-3">-->
                    <!--<TriviaTeam :team="team"></TriviaTeam>-->
                <!--</div>-->
            <!--</div>-->
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