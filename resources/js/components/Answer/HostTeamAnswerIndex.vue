<template>
    <div>
        <div v-if="teamAnswers.filter(x => x.team_id === team.id).length !== 0">
            <div v-for="round in rounds">
                <div class="row">
                    <div class="col-12">
                        <h4>Round {{round.order_number}}:</h4>
                    </div>
                </div>
                <div class="row pb-5">
                    <div class="col-11 col-centered">
                        <div class="pt-3" v-for="question in questions.filter(x => x.round_id === round.id)">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <small class="text-muted">Question {{question.order_number}}</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-0">{{question.title}}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <small class="text-muted" v-if="answers.filter(x => x.question_id === question.id && x.correct === 1).length === 1">
                                                <b>Possible Answer(s): </b>
                                                <span v-for="answer in answers.filter(x => x.question_id === question.id && x.correct === 1)">
                                            {{answer.title}}
                                        </span>
                                            </small>
                                            <small class="text-muted" v-else>
                                                <b>Possible Answer(s): </b>
                                                <span v-for="(answer, index) in answers.filter(x => x.question_id === question.id && x.correct === 1)">
                                            {{answer.title}}<span v-if="answers.filter(x => x.question_id === question.id && x.correct === 1).length !== index+1">,</span>
                                        </span>
                                            </small>
                                        </div>
                                    </div>
                                    <!--Team Headers-->
                                    <div class="row pt-4">
                                        <div class="col-4 col-md-3">
                                            <small class="text-muted">Team Name</small>
                                        </div>
                                        <div class="col-4 col-md-4 pr-2">
                                            <small class="text-muted">Answer</small>
                                        </div>
                                        <!--Disappears when screen is too small-->
                                        <div class="col-2 pr-2 d-none d-md-flex">
                                            <small class="text-muted">Grade</small>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <div class="float-right">
                                                <small class="text-muted">Change Points</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-3">
                                        <HostRoundReviewTeamRow :team="team" :question="question"></HostRoundReviewTeamRow>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h4>No Answers yet :(</h4>
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
        computed: {
            ...mapGetters('team', ['team', 'teamAnswers']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('round', ['rounds']),
            changeAnswer(id, change) {
                if (this.teamAnswers.find(x => x.id === id && x.correct !== change)) {

                    for (let $i = 0; $i < this.teamAnswers.length; $i++) {
                        if (this.teamAnswers[$i].id === id) {

                            this.team_Answers = {
                                answer: this.teamAnswers[$i],
                                order: $i
                            };
                        }
                    }
                }

            }

        }
    }
</script>

<style scoped>

</style>
