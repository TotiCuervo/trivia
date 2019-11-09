<template>
    <div v-if="this.teamAnswer">
        <b-button v-show="this.teamAnswer.correct" variant="success" squared v-b-tooltip.left title="Marked right">
            <i class="fas fa-check"></i>
        </b-button>
        <b-button v-show="!this.teamAnswer.correct" variant="outline-success" squared @click="changeAnswer(true)" v-b-tooltip.left title="Click to mark right">
            <i class="fas fa-check"></i>
        </b-button>

        <b-button v-show="!this.teamAnswer.correct" variant="danger" squared v-b-tooltip.right title="Marked wrong">
            <i class="fas fa-ban"></i>
        </b-button>
        <b-button v-show="this.teamAnswer.correct" variant="outline-danger" squared @click="changeAnswer(false)" v-b-tooltip.right title="Click to mark wrong">
            <i class="fas fa-ban"></i>
        </b-button>

<!--            <span class="clicker" v-bind:class="{'text-muted': !this.answer.correct, 'text-success': this.answer.correct}"-->
<!--                  v-b-tooltip.left title="Click to mark right" @click="changeAnswer(true)">-->
<!--                <i class="fas fa-check"></i>-->
<!--            </span>-->
<!--        <span> / </span>-->
<!--        <span class="clicker" v-bind:class="{'text-muted': this.answer.correct, 'text-danger': !this.answer.correct}"-->
<!--              v-b-tooltip.right title="Click to mark wrong" @click="changeAnswer(false)">-->
<!--                <i class="fas fa-ban"></i>-->
<!--            </span>-->
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
        },
        methods: {
            ...mapActions('team', ['updateTeamAnswerCorrect']),
            ...mapActions('host', ['sendPlayersLeaderBoard']),
            changeAnswer(change) {
                if (!this.teamAnswer.correct === change) {
                    this.updateTeamAnswerCorrect(this.teamAnswer);
                }
            }
        },
        computed: {
            ...mapGetters('team', ['teams', 'teamAnswers']),
            teamAnswer: {
                get() {
                    return this.teamAnswers.find(x => x.team_id === this.team.id && x.question_id === this.question.id);
                },
                set(value) {
                    return null;
                }
            }
        },
        props: ['team','question'],
    }
</script>

<style scoped>

</style>
