<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <small>Round {{this.rounds[roundPosition].order_number}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-left">
                    <h4>Question {{this.questions[questionPosition].order_number}}</h4>
                </div>
                <div class="float-right">
                    <div v-if="this.revealAnswer === true">
                        <button type="button" class="btn btn-success btn-lg mr-2" @click='onUpNext()'>Up Next: {{upNext}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12 pt-5 text-center">
                <h2>{{this.questions[questionPosition].title}}</h2>
            </div>
        </div>
        <div class="row pt-3">

            <div class="col-md-8 offset-md-2 text-center pt-5" v-if="revealAnswer === false">
                <button type="button" class="btn btn-success btn-lg btn-block" @click="showAnswer">Reveal Answer</button>
                <small class="form-text text-muted">Press this when you are ready to show the Teams the correct answer</small>
            </div>

            <div class="col-md-12 text-center pt-5" v-if="revealAnswer === true">
                <div class="row pb-4">
                    <div class="col-md-12">
                        <h2>Answers:</h2>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div v-for="answer in this.answers">
                            <div class="col" v-if="answer.question_id === questions[questionPosition].id">
                                <h4>{{answer.title}}</h4>
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
                upNext: '',
                newQuestionPosition: '',
                revealAnswer: false,
            }
        },
        mounted() {

        },
        methods: {

            onUpNext() {

                this.revealAnswer = false;
                this.upNext =  '';

                if (this.newQuestionPosition !== "") {
                    this.$emit('goToDestination', this.roundPosition, this.newQuestionPosition, 'HostAnswerReveal');
                } else {
                    this.$emit('goToDestination', this.roundPosition, 0, 'HostLeaderBoard');
                }
            },

            showAnswer() {
                this.revealAnswer = true;

                if (this.questionPosition + 1 === this.questions.length) {
                    this.newQuestionPosition = '';
                    this.upNext = 'Leaderboard';
                } else {

                    if (this.questions[this.questionPosition + 1].round_id === this.rounds[this.roundPosition].id) {
                        this.upNext = 'Reveal Question ' + this.questions[this.questionPosition + 1].order_number + ' Answer';
                        this.newQuestionPosition = this.questionPosition + 1;
                    } else {
                        this.newQuestionPosition = '';
                        this.upNext = 'Leaderboard';
                    }

                }
            }
        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('answer', ['answers'])
        },
        props: ['questionPosition', 'roundPosition']
    }
</script>

<style scoped>

</style>