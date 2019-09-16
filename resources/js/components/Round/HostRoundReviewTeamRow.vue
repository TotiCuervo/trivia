<template>
    <div class="row">
        <div class="col-5">
            <p class="m-0">
                <HostTeamName :team="this.team"></HostTeamName>
            </p>
        </div>
        <div class="col-5">
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
        <div class="col-2">
            <div class="float-right">
                <HostChangeAnswer :team="team" :question="question"></HostChangeAnswer>
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
        props: ['team', 'question'],
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('team', ['teams', 'teamAnswers']),
        },
    }
</script>

<style scoped>

</style>