<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <small>Round {{this.rounds[this.playRoundPosition].order_number}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-left">
                    <h4>Question {{this.questions[this.playQuestionPosition].order_number}}</h4>
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
                <h2>{{this.questions[this.playQuestionPosition].title}}</h2>
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
                            <div class="col" v-if="answer.question_id === questions[playQuestionPosition].id">
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
                    axios.post('/api/host/' + this.gameCode.code + '/round/'+ this.playRoundPosition + '/question/' + this.newQuestionPosition + '/currentPage/'+'PlayRevealAnswer')
                        .then(response => {

                        });
                    this.playQuestionPosition = this.newQuestionPosition;
                    this.currentPage="HostAnswerReveal";
                } else {
                    axios.post('/api/host/' + this.gameCode.code + '/round/'+ this.playRoundPosition + '/question/' + 0 + '/currentPage/'+'PlayLeaderBoard')
                        .then(response => {

                        });
                    this.playQuestionPosition = 0;
                    this.currentPage="HostLeaderBoard";
                }
            },

            showAnswer() {
                this.revealAnswer = true;

                axios.post('/api/host/revealAnswer');

                if (this.playQuestionPosition + 1 === this.questions.length) {
                    this.newQuestionPosition = '';
                    this.upNext = 'Leaderboard';
                } else {

                    if (this.questions[this.playQuestionPosition + 1].round_id === this.rounds[this.playRoundPosition].id) {
                        this.upNext = 'Reveal Question ' + this.questions[this.playQuestionPosition + 1].order_number + ' Answer';
                        this.newQuestionPosition = this.playQuestionPosition + 1;
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
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            playRoundPosition: {
                get() {
                    return this.roundPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_ROUND_POSITION', value);
                }
            },
            playQuestionPosition: {
                get() {
                    return this.questionPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_QUESTION_POSITION', value);
                }
            },
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            }
        },
    }
</script>

<style scoped>

</style>