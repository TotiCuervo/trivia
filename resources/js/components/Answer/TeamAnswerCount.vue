<template>
    <h5 class="pt-2 mb-0">{{this.teamsThatHaveAnswered}}/{{this.teams.length}} Answers</h5>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                teamsThatHaveAnswered: 0,
            }
        },
        mounted() {

            Echo.join('game.'+this.gameCode.code)
                .listen('NewTeamAnswer', (e) => {
                    this.teamsThatHaveAnswered++;
                });
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('team', ['teams', 'teamAnswers']),
        },
    }
</script>

<style scoped>

</style>
