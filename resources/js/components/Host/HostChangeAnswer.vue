<template>
    <div>
        <div v-for="answer in teamAnswers.filter(x => x.team_id === team.id && x.question_id === question.id)">
            <i class="fas fa-check" v-bind:class="{'text-muted': answer.correct === 0, 'text-success': answer.correct === 1}"
               v-b-tooltip.left title="Click to mark right" @click="changeAnswer(answer.id, 1)"></i>
            <span> / </span>
            <i class="fas fa-ban" v-bind:class="{'text-muted': answer.correct === 1, 'text-danger': answer.correct === 0}"
               v-b-tooltip.right title="Click to mark wrong" @click="changeAnswer(answer.id, 0)"></i>
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

        },
        methods: {
            ...mapActions('team', ['updateTeamAnswerCorrect']),
            changeAnswer(id, change) {
                if (this.teamAnswers.find(x => x.id === id && x.correct !== change)) {


                    for (let $i = 0; $i < this.teamAnswers.length; $i++) {
                        if (this.teamAnswers[$i].id === id) {

                            this.updateTeamAnswerCorrect({
                                answer: this.teamAnswers[$i],
                                order: $i
                            });
                        }
                    }
                }

            }
        },
        computed: {
            ...mapGetters('team', ['teams', 'teamAnswers']),
        },
        props: ['team','question']
    }
</script>

<style scoped>

</style>