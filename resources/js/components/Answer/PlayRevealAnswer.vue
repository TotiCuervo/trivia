<template>
    <div class="container" id="reveal-answer">
        <!--Question Title-->
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>{{this.questions[questionPosition].title}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--Fill in Blank-->
        <div v-if="this.questions[questionPosition].type === 'Fill-in-blank'">
            <div class="row pt-5 fill-in-blank">
                <div class="col-md-4 offset-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Team Answer:</h4>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12 text-center">
                            <h5 v-if="teamAnswers.find(x => x.question_id === questions[questionPosition].id)">
                                {{teamAnswers.find(x => x.question_id === questions[questionPosition].id).answer}}
                            </h5>
                            <h5 v-else>
                                No Answer :/
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-5" v-if="revealAnswer === true">
                <div class="col-md-4 offset-md-4 text-center">
                    <div v-for="answer in this.answers">
                        <div class="row pt-3" v-if="answer.correct === 1 && answer.question_id === questions[questionPosition].id">
                            <div class="col-md-12">
                                <h5>{{answer.title}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Multiple Choice-->
        <div v-else>
            <div class="row pt-5">
                <div class="col-md-4 offset-md-4 text-center">
                    <div class="row pb-3" v-for="(answer,index) in this.answers.filter(x => x.question_id === this.questions[this.questionPosition].id)">
                        <div class="col-md-12 text-center">
                            <div class v-if="teamAnswers.find(x => x.question_id === questions[questionPosition].id)">

                                <div class="answer-card card" v-bind:class="{isChosen: (teamAnswers.find(x => x.question_id === questions[questionPosition].id).answer === answer.title && revealAnswer === false), 'bg-success text-white': (answer.correct === 1 && revealAnswer === true), 'bg-danger text-white': (teamAnswers.find(x => x.question_id === questions[questionPosition].id).answer === answer.title && teamAnswers.find(x => x.question_id === questions[questionPosition].id).correct === 0 && revealAnswer === true)}">
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                        <span class="m-0 float-left pl-2"
                                              v-bind:class="{'text-white': teamAnswers.find(x => x.question_id === questions[questionPosition].id).answer === answer.title || (answer.correct === 1 && revealAnswer === true), 'color-red': index === 0, 'color-blue': index === 1, 'color-green': index === 2, 'color-yellow': index === 3}">

                                            <b>{{options[index]}}</b>
                                        </span>
                                                <span class="h5 m-0 pr-2">{{answer.title}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-else>
                                <div class="answer-card card" v-bind:class="{'bg-success text-white': (answer.correct === 1 && revealAnswer === true)}">
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                        <span class="m-0 float-left pl-2" v-bind:class="{'text-white': (answer.correct === 1 && revealAnswer === true), 'color-red': index === 0, 'color-blue': index === 1, 'color-green': index === 2, 'color-yellow': index === 3}">
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
                <div class="col-md-4 offset-md-4 text-center" v-if="!(teamAnswers.find(x => x.question_id === questions[questionPosition].id))">
                    <h5>Uh Oh, looks like you didn't answer this question</h5>
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
                options: ['A', 'B', 'C', 'D']
            }
        },
        mounted() {

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
            revealAnswer: function () {
                let $answer = this.teamAnswers.find(x => x.question_id === this.questions[this.questionPosition].id);

                if (this.revealAnswer === true) {

                    if (this.questions[this.questionPosition].type === 'Fill-in-blank') {
                        if (this.teamAnswers.find(x => x.question_id === this.questions[this.questionPosition].id) && $answer.correct === 1) {
                            document.querySelector('body').style.backgroundColor = 'green';
                        } else {
                            document.querySelector('body').style.backgroundColor = 'red';
                        }
                        document.getElementById('reveal-answer').style.color = 'white';
                    }

                }

            },
            questionPosition: function () {
                document.getElementById('reveal-answer').style.color = 'black';
            },

        }
    }
</script>

<style scoped>

</style>