<template>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="text-center col" v-for="team in this.answerPool">
                    <HostTriviaTeamAnswer :team="team.team" :answered="!team.answered"></HostTriviaTeamAnswer>
                </div>
            </div>
        </div>
        <div class="col-md-6 vl">
            <div class="row">
                <div class="text-center col" v-for="team in this.answerPool">
                    <HostTriviaTeamAnswer :team="team.team" :answered="team.answered"></HostTriviaTeamAnswer>
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
                answerPool: []
            }
        },
        mounted() {

            for (let $i=0; $i < this.teams.length; $i++) {
                this.answerPool.push({
                    team: this.teams[$i],
                    answered: false
                })
            }

            Echo.join('game.'+this.gameCode.code)
                .listen('NewTeamAnswer', (e) => {
                    console.log('made it to new team answer');
                    console.log(e);

                    for (let $i=0; $i < this.answerPool.length; $i++) {
                        if (this.answerPool[$i].team.id === e.teamAnswer.team_id) {
                            this.answerPool[$i].answered = true;
                        }
                    }
                });

        },
        methods: {

        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('team', ['teams', 'teamAnswers']),
        },
        watch: {
            teams: function() {

                for (let $i=0; $i < this.teams.length; $i++) {
                    if (!this.answerPool.find(x => x.team.id === this.teams[$i].id)) {
                        this.answerPool.push({
                            team: this.teams[$i],
                            answered: false
                        })
                    }
                }

            }
        }
    }
</script>

<style scoped>

</style>