
<template>
    <div>
        <!--for xs and sm-->
        <div class="row d-flex d-md-none">
            <div class="col-4">
                <p class="m-0">
                    <HostTeamName :team="this.team"></HostTeamName>
                </p>
            </div>
            <div class="col-4">
                <div v-if="teamAnswer">
                    <div v-if="this.question.type === 'Fill-in-blank'">
                        <h5 class="mb-0 pointer" v-if="this.teamAnswer.matchIndex === 0" v-b-tooltip.left title="Correct">
                            <span class="badge badge-success p-2">{{this.teamAnswer.answer}}</span>
                        </h5>

                        <h5 class="mb-0 pointer" v-if="this.teamAnswer.matchIndex > 0 && this.teamAnswer.matchIndex <= 4" v-b-tooltip.left title="Probably correct">
                            <span class="badge list-group-item-success p-2">{{this.teamAnswer.answer}}</span>
                        </h5>

                        <h5 class="mb-0 pointer" v-else-if="this.teamAnswer.matchIndex > 4 && this.teamAnswer.matchIndex <= 7" v-b-tooltip.left title="Maybe correct">
                            <span class="badge list-group-item-warning p-2">{{this.teamAnswer.answer}}</span>
                        </h5>

                        <h5 class="mb-0 pointer" v-else-if="this.teamAnswer.matchIndex > 8" v-b-tooltip.left title="Probably not correct">
                            <span class="badge list-group-item-danger p-2">{{this.teamAnswer.answer}}</span>
                        </h5>
                    </div>
                    <div v-else>
                        <h5 class="mb-0 pointer" v-if="this.teamAnswer.matchIndex === 0" v-b-tooltip.left title="Correct">
                            <span class="badge badge-success p-2">{{this.teamAnswer.answer}}</span>
                        </h5>
                        <h5 class="mb-0 pointer" v-else v-b-tooltip.left title="Wrong">
                            <span class="badge badge-danger p-2">{{this.teamAnswer.answer}}</span>
                        </h5>
                    </div>
                </div>
                <div v-else>
                    <h5 class="mb-0 pointer" v-if="teamAnswers.filter(x => x.team_id === this.team.id && x.question_id === question.id).length === 0" v-b-tooltip.left title=" ¯\_(ツ)_/¯">
                        <span class="badge badge-danger p-2">No Answer</span>
                    </h5>
                </div>
            </div>
            <div class="col-4">
                <div class="float-right">
                    <HostChangeAnswer :team="team" :question="question"></HostChangeAnswer>
                </div>
            </div>
            <div class="col-12" v-if="this.index + 1 !== this.teams.length">
                <hr>
            </div>
        </div>

        <!--For md and larger-->
        <div class="row d-none d-md-flex">
            <div class="col-3">
                <p class="m-0">
                    <HostTeamName :team="this.team"></HostTeamName>
                </p>
            </div>
            <div class="col-4">
                <div v-if="teamAnswer">
                    <p class="m-0">{{this.teamAnswer.answer}}</p>
                </div>
                <div v-else>
                    <p class="m-0">No Answer</p>
                </div>
            </div>
            <div class="col-3">
                <div v-if="teamAnswer">
                    <div v-if="this.question.type === 'Fill-in-blank'">
                        <h5 class="mb-0 pointer" v-if="this.teamAnswer.matchIndex === 0">
                            <span class="badge badge-success p-2">Correct</span>
                        </h5>

                        <h5 class="mb-0 pointer" v-if="this.teamAnswer.matchIndex > 0 && this.teamAnswer.matchIndex <= 4">
                            <span class="badge list-group-item-success p-2">Probably Correct</span>
                        </h5>

                        <h5 class="mb-0 pointer" v-else-if="this.teamAnswer.matchIndex > 4 && this.teamAnswer.matchIndex <= 7" v-b-tooltip.left title="Maybe correct">
                            <span class="badge list-group-item-warning p-2">Maybe Correct</span>
                        </h5>

                        <h5 class="mb-0 pointer" v-else-if="this.teamAnswer.matchIndex > 8">
                            <span class="badge list-group-item-danger p-2">Probably Not Correct</span>
                        </h5>
                    </div>
                    <div v-else>
                        <h5 class="mb-0 pointer" v-if="this.teamAnswer.matchIndex === 0">
                            <span class="badge badge-success p-2">Correct</span>
                        </h5>
                        <h5 class="mb-0 pointer" v-else v-b-tooltip.left title="Wrong">
                            <span class="badge badge-danger p-2">Wrong</span>
                        </h5>
                    </div>
                </div>
                <div v-else>
                    <h5 class="mb-0 pointer" v-if="teamAnswers.filter(x => x.team_id === this.team.id && x.question_id === question.id).length === 0" v-b-tooltip.left title=" ¯\_(ツ)_/¯">
                        <span class="badge badge-danger p-2">No Answer</span>
                    </h5>
                </div>
            </div>
            <div class="col-2">
                <div class="float-right">
                    <HostChangeAnswer :team="team" :question="question"></HostChangeAnswer>
                </div>
            </div>
            <div class="col-12" v-if="this.index + 1 !== this.teams.length">
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                teamAnswer: '',
            }
        },
        mounted() {
            this.teamAnswer = this.teamAnswers.find(x => x.team_id === this.team.id && x.question_id === this.question.id);
        },
        methods: {

        },
        props: ['team', 'question', 'index'],
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('team', ['teams', 'teamAnswers']),
        },
    }
</script>

<style scoped>

</style>
