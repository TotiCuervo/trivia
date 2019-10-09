<template>
    <div>
        <div v-if="this.answer">
            <span class="clicker" v-bind:class="{'text-muted': !this.answer.correct, 'text-success': this.answer.correct}"
                  v-b-tooltip.left title="Click to mark right" @click="changeAnswer(true)">
                <i class="fas fa-check"></i>
            </span>
            <span> / </span>
            <span class="clicker" v-bind:class="{'text-muted': this.answer.correct, 'text-danger': !this.answer.correct}"
                  v-b-tooltip.right title="Click to mark wrong" @click="changeAnswer(false)">
                <i class="fas fa-ban"></i>
            </span>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                answer: ''
            }
        },
        mounted() {
            this.getAnswer();
        },
        methods: {
            ...mapActions('team', ['updateTeamAnswerCorrect']),
            getAnswer() {
                this.answer = this.teamAnswers.find(x => x.team_id === this.team.id && x.question_id === this.question.id);

            },
            changeAnswer(change) {
                if (!this.answer.correct === change) {
                    this.updateTeamAnswerCorrect(this.answer);
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
        watch: {
            teamAnswers: function () {
                this.getAnswer();
            },
        }
    }
</script>

<style scoped>

</style>