<template>
    <div>
        <!--Navigation-->
        <div class="row">
            <div class="col-5">
                <div class="float-left">
                    <small>Round {{this.rounds[this.playRoundPosition].order_number}}</small>
                    <p class="mb-0">Question {{this.questions[this.playQuestionPosition].order_number}}</p>
                    <h5 class="mb-0">{{this.questions[this.playQuestionPosition].type}}</h5>
                </div>
            </div>
            <div class="col-7">
                <div class="float-right">
                    <div v-if="this.revealAnswer === true">
                        <button type="button" class="btn btn-success btn-lg mr-2" @click='onUpNext()'>{{upNext}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Question Title-->
        <div class="row pt-3">
            <div class="col-md-12 pt-5 text-center">
                <h2>{{this.questions[this.playQuestionPosition].title}}</h2>
            </div>
        </div>
        <!--Multiple Choice Optional-->
        <div class="pt-3" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'">
            <HostMultipleChoiceAnswerOptions :revealAnswer="revealAnswer"></HostMultipleChoiceAnswerOptions>
        </div>
        <!--Fill In The Blank-->
        <div v-if="revealAnswer === true && this.questions[this.playQuestionPosition].type === 'Fill-in-blank' ">
            <div class="col-md-12 text-center pt-5">
                <div class="row pb-4">
                    <div class="col-md-12">
                        <h2>Answers:</h2>
                    </div>
                </div>
                <div class="row pb-3" v-for="answer in this.answers">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-4 offset-md-4 text-center" v-if="answer.question_id === questions[playQuestionPosition].id">
                        <div class="answer-card card">
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="m-0">{{answer.title}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Answer Reveal-->
        <div class="row pt-3">
            <!--Reveal Button-->
            <div class="col-md-8 offset-md-2 text-center pt-5" v-if="revealAnswer === false">
                <button type="button" class="btn btn-success btn-lg btn-block" @click="showAnswer">Reveal Answer</button>
                <small class="form-text text-muted">Press this when you are ready to show the Teams the correct answer</small>
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

            Echo.join('game.'+this.gameCode.code)
                .listen('NewTeam', (e) => {
                    if(this.currentPage === 'HostAnswerReveal') {
                        console.log('current page');
                        console.log(this.currentPage);

                        console.log('sent this:');
                        console.log('PlayRevealAnswer');

                        axios.post('/api/host/'+ this.gameCode.code + '/round/' + this.playRoundPosition +'/question/' + this.playQuestionPosition + '/currentPage/' + 'PlayRevealAnswer')
                            .then (response => {
                                if (this.revealAnswer) {
                                    axios.post('/api/host/game/'+ this.gameCode.code +'/question/'+ this.questionPosition +'/revealAnswer');
                                }
                            });
                    }

                });

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

                axios.post('/api/host/game/'+ this.gameCode.code +'/question/'+ this.questionPosition +'/revealAnswer');

                this.revealAnswer = true;

                if (this.playQuestionPosition + 1 === this.questions.length) {
                    this.newQuestionPosition = '';
                    this.upNext = 'Leaderboard';
                } else {

                    if (this.questions[this.playQuestionPosition + 1].round_id === this.rounds[this.playRoundPosition].id) {
                        this.upNext = 'Question ' + this.questions[this.playQuestionPosition + 1].order_number + ' Answer';
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