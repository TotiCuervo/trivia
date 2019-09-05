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
                    <div class="col-10 offset-1">
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
                                    <div class="row pt-4">
                                        <div class="col-8">
                                            <small class="text-muted">Answer</small>
                                        </div>
                                        <div class="col-4">
                                            <div class="float-right">
                                                <small class="text-muted">Change Points</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-8">
                                            <div v-if="question.type === 'Fill-in-blank'">
                                                <div v-for="answer in teamAnswers.filter(x => x.team_id === team.id && x.question_id === question.id)">
                                                    <h5 class="mb-0 pointer" v-if="answer.matchIndex === 0" v-b-tooltip.left title="Correct">
                                                    <span class="badge badge-success p-2">
                                                        {{answer.answer}}
                                                    </span>
                                                    </h5>

                                                    <h5 class="mb-0 pointer" v-if="answer.matchIndex > 0 && answer.matchIndex <= 4" v-b-tooltip.left title="Probably correct">
                                                    <span class="badge list-group-item-success p-2">
                                                        {{answer.answer}}
                                                    </span>
                                                    </h5>

                                                    <h5 class="mb-0 pointer" v-else-if="answer.matchIndex > 4 && answer.matchIndex <= 7" v-b-tooltip.left title="Maybe correct">
                                                    <span class="badge list-group-item-warning p-2">
                                                        {{answer.answer}}
                                                    </span>
                                                    </h5>

                                                    <h5 class="mb-0 pointer" v-else-if="answer.matchIndex > 8" v-b-tooltip.left title="Probably not correct">
                                                    <span class="badge list-group-item-danger p-2">
                                                        {{answer.answer}}
                                                    </span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div v-for="answer in teamAnswers.filter(x => x.team_id === team.id && x.question_id === question.id)">
                                                    <h5 class="mb-0 pointer" v-if="answer.matchIndex === 0" v-b-tooltip.left title="Correct">
                                                <span class="badge badge-success p-2">
                                                    {{answer.answer}}
                                                </span>
                                                    </h5>
                                                    <h5 class="mb-0 pointer" v-else v-b-tooltip.left title="Wrong">
                                                <span class="badge badge-danger p-2">
                                                    {{answer.answer}}
                                                </span>
                                                    </h5>
                                                </div>

                                            </div>
                                            <h5 class="mb-0 pointer" v-if="teamAnswers.filter(x => x.team_id === team.id && x.question_id === question.id).length === 0"
                                                v-b-tooltip.left title=" ¯\_(ツ)_/¯">
                                            <span class="badge badge-danger p-2">
                                                No Answer
                                            </span>
                                            </h5>
                                        </div>
                                        <div class="col-4">
                                            <div class="float-right">
                                                <HostChangeAnswer :team="team" :question="question"></HostChangeAnswer>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <!--<div class="row pt-3" v-for="question in questions.filter(x => x.round_id === round.id)">-->
                    <!--<div class="col-12">-->
                        <!--<h6>{{question.title}}</h6>-->
                    <!--</div>-->
                <!--</div>-->
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