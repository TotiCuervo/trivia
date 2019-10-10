<template>
    <div>
        <div class="row pt-5">
            <div class="col-md-4 offset-md-4 text-center">
                <div class="row pb-3" v-for="(answer,index) in this.questionAnswers">
                    <div class="col-md-12 text-center">
                        <div class v-if="teamAnswer">
                            <div class="answer-card card" v-bind:class="answerCardBind(answer, index)">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <span class="m-0 float-left pl-2" v-bind:class="{'text-white': teamAnswer.answer === answer.title || (answer.correct && revealAnswer), 'color-red': index === 0, 'color-blue': index === 1, 'color-green': index === 2, 'color-yellow': index === 3}">
                                            <b>{{options[index]}}</b>
                                        </span>
                                            <span class="h5 m-0 pr-2" v-bind:class="{'text-white': darkMode}">{{answer.title}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else>
                            <div class="answer-card card" v-bind:class="notAnswerCardBind(answer, index)">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <span class="m-0 float-left pl-2" v-bind:class="{'text-white': answer.correct && revealAnswer, 'color-red': index === 0, 'color-blue': index === 1, 'color-green': index === 2, 'color-yellow': index === 3}">
                                            <b>{{options[index]}}</b>
                                        </span>
                                            <span class="h5 m-0 pr-2" v-bind:class="{'text-white': darkMode}">{{answer.title}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4 text-center"
                 v-if="!this.teamAnswer">
                <h5 v-bind:class="{'text-white': this.darkMode}">Uh Oh, looks like you didn't answer this question</h5>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                options: ['A', 'B', 'C', 'D'],
                questionAnswers: '',
                teamAnswer: '',
            }
        },
        mounted() {
            this.sortVariables();
        },
        methods: {
            sortVariables() {
                this.questionAnswers = this.answers.filter(x => x.question_id === this.questions[this.questionPosition].id);
                this.teamAnswer = this.teamAnswers.find(x => x.question_id === this.questions[this.questionPosition].id);
            },
            answerCardBind(answer, index) {
                return {

                    //Chosen Answers
                    'isChosen': this.teamAnswer.answer === answer.title && !this.revealAnswer && !this.darkMode,
                    'darkMode-answer-card color-white': this.teamAnswer.answer === answer.title && !this.revealAnswer && this.darkMode,

                    //When revealAnswer is shown
                    'bg-success text-white': (answer.correct && this.revealAnswer),
                    'bg-danger text-white': (this.teamAnswer.answer === answer.title && !this.teamAnswer.correct && this.revealAnswer),

                    //dark mode outline colors
                    'darkMode-bc border-1': this.darkMode && ((this.teamAnswer.answer !== answer.title && !this.revealAnswer) || (this.revealAnswer && this.teamAnswer.answer !== answer.title && !answer.correct)),
                    'color-red': this.darkMode && index === 0 && ((!this.revealAnswer && this.teamAnswer.answer !== answer.title) || (this.revealAnswer && !answer.correct)),
                    'color-blue': this.darkMode && index === 1 && ((!this.revealAnswer && this.teamAnswer.answer !== answer.title) || (this.revealAnswer && !answer.correct)),
                    'color-green': this.darkMode && index === 2 && ((!this.revealAnswer && this.teamAnswer.answer !== answer.title) || (this.revealAnswer && !answer.correct)),
                    'color-yellow': this.darkMode && index === 3 && ((!this.revealAnswer && this.teamAnswer.answer !== answer.title) || (this.revealAnswer && !answer.correct)),

                }
            },
            notAnswerCardBind(answer, index) {
                return {
                    'bg-success text-white': answer.correct && this.revealAnswer,
                    'darkMode-bc border-1': this.darkMode && ((!this.revealAnswer) || (this.revealAnswer && !answer.correct)),
                    'color-red': this.darkMode && index === 0 && ((!this.revealAnswer) || (this.revealAnswer && !answer.correct)),
                    'color-blue': this.darkMode && index === 1 && ((!this.revealAnswer) || (this.revealAnswer && !answer.correct)),
                    'color-green': this.darkMode && index === 2 && ((!this.revealAnswer) || (this.revealAnswer && !answer.correct)),
                    'color-yellow': this.darkMode && index === 3 && ((!this.revealAnswer) || (this.revealAnswer && !answer.correct)),
                }
            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('team', ['teamAnswers']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page', 'myAnswers']),
            ...mapGetters('user', ['darkMode']),

        },
        props: ['revealAnswer'],
        watch: {
            questionPosition: function () {
                document.getElementById('reveal-answer').style.color = 'black';
                this.sortVariables();
            },

        }
    }
</script>

<style scoped>

</style>
