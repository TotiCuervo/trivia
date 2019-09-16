<template>
    <div>
        <div class="row pt-5">
            <div class="col-md-4 offset-md-4 text-center">
                <div class="row pb-3"
                     v-for="(answer,index) in this.questionAnswers">
                    <div class="col-md-12 text-center">

                        <div class v-if="teamAnswer">
                            <div class="answer-card card"
                                 v-bind:class="{isChosen: (teamAnswer.answer === answer.title && !revealAnswer), 'bg-success text-white': (answer.correct && revealAnswer), 'bg-danger text-white': (teamAnswer.answer === answer.title && !teamAnswer.correct && revealAnswer)}">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <span class="m-0 float-left pl-2" v-bind:class="{'text-white': teamAnswer.answer === answer.title || (answer.correct && revealAnswer), 'color-red': index === 0, 'color-blue': index === 1, 'color-green': index === 2, 'color-yellow': index === 3}">
                                            <b>{{options[index]}}</b>
                                        </span>
                                            <span class="h5 m-0 pr-2">{{answer.title}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else>
                            <div class="answer-card card"
                                 v-bind:class="{'bg-success text-white': (answer.correct && revealAnswer)}">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <span class="m-0 float-left pl-2" v-bind:class="{'text-white': (answer.correct && revealAnswer), 'color-red': index === 0, 'color-blue': index === 1, 'color-green': index === 2, 'color-yellow': index === 3}">
                                            <b>{{options[index]}}</b>
                                        </span>
                                            <span class="h5 m-0 pr-2">{{answer.title}}</span>
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
                <h5>Uh Oh, looks like you didn't answer this question</h5>
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
            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('team', ['teamAnswers']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page', 'myAnswers']),
        },
        props: ['revealAnswer'],
        watch: {
            // revealAnswer: function () {
            //     let $answer = this.teamAnswers.find(x => x.question_id === this.questions[this.questionPosition].id);
            //
            //     if (this.revealAnswer === true) {
            //
            //         if (this.questions[this.questionPosition].type === 'Fill-in-blank') {
            //             if (this.teamAnswers.find(x => x.question_id === this.questions[this.questionPosition].id) && $answer.correct === 1) {
            //                 document.querySelector('body').style.backgroundColor = 'green';
            //             } else {
            //                 document.querySelector('body').style.backgroundColor = 'red';
            //             }
            //             document.getElementById('reveal-answer').style.color = 'white';
            //         }
            //
            //     }
            //
            // },
            questionPosition: function () {
                document.getElementById('reveal-answer').style.color = 'black';
                this.sortVariables();
            },

        }
    }
</script>

<style scoped>

</style>