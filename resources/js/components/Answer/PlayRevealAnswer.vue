<template>
    <div class="container" id="reveal-answer">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>{{this.questions[questionPosition].title}}</h3>
                    </div>
                </div>
            </div>
        </div>
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
                            <h5>
                                {{teamAnswers.find(x => x.question_id === questions[questionPosition].id).answer}}
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
        <div class="row pt-5" v-else>
            <div class="col-md-4 offset-md-4 text-center">
                <div v-for="answer in this.answers">
                    <div class="row pb-3" v-if="answer.question_id === questions[questionPosition].id">
                        <div class="col-md-12 text-center">
                            <div class="fancy2 card"
                                 v-bind:class="{isChosen: (teamAnswers.find(x => x.question_id === questions[questionPosition].id).answer === answer.title
                                 && revealAnswer === false),
                                 'bg-success text-white': (answer.correct === 1 && revealAnswer === true),
                                 'bg-danger text-white': (teamAnswers.find(x => x.question_id === questions[questionPosition].id).answer === answer.title
                                 && teamAnswers.find(x => x.question_id === questions[questionPosition].id).correct === 0
                                 && revealAnswer === true)}">
                                <div class="card-body p-2">
                                    <h5 class="mb-0">{{answer.title}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        if ($answer.correct === 1) {
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