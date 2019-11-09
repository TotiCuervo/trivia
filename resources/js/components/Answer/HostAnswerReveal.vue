<template>
    <div>
        <!--SubHeader-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">

                    <!--left-->
                    <h5 class="mb-0">Answer Reveal</h5>

                    <!--Center-->
                    <h6 class="mb-0 d-none d-sm-flex" v-if="this.questions[this.playQuestionPosition].type === 'Fill-in-blank'"> Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}} Fill In The Blank </h6>
                    <h6 class="mb-0 d-none d-sm-flex" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'"> Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}} Multiple Choice </h6>

                    <!--right-->
                    <b-button pill variant="primary" @click='onUpNext()' v-if="this.revealAnswer">{{upNext}}</b-button>

                    <span v-b-tooltip.left title='Reveal answer to continue' tabindex="0" v-else>
                        <b-button pill  disabled variant="primary">{{upNext}}</b-button>
                    </span>
                </div>
            </div>
        </div>

        <!--Question Title-->
        <div class="row pt-5">
            <div class="col-md-6 offset-md-3 pt-3">
                <div class="hostQuestion-card card">
                    <div class="card-body">
                        <div class="row p-5">
                            <div class="col-md-12 text-center">
                                <h4 class="m-0">{{this.questions[this.playQuestionPosition].title}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Multiple Choice Optional-->
        <div class="pt-3" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'">
            <HostMultipleChoiceAnswerOptions :revealAnswer="revealAnswer"></HostMultipleChoiceAnswerOptions>
        </div>

        <!--Fill In The Blank-->
        <div v-if="revealAnswer === true && this.questions[this.playQuestionPosition].type === 'Fill-in-blank' ">
            <div class="col-md-12 text-center pt-5">
                <div class="row pb-2">
                    <div class="col-md-12">
                        <h5>Answer(s):</h5>
                    </div>
                </div>
                <div class="row pb-3" v-for="answer in this.answers.filter(x => x.question_id === questions[playQuestionPosition].id)">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-4 offset-md-4 text-center">
                        <div class="answer-card card">
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="m-0">{{answer.title}}</h5>
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
            <div class="col-md-6 offset-md-3 text-center pt-3" v-if="revealAnswer === false">
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
            this.decideUpNext();

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
            ...mapActions('host', ['sendPlayersPage', 'revealAnswerToPlayers']),
            decideUpNext() {
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
            },
            onUpNext() {

                this.revealAnswer = false;
                this.upNext =  '';

                if (this.newQuestionPosition !== "") {
                    this.playQuestionPosition = this.newQuestionPosition;
                    this.sendPlayersPage('PlayRevealAnswer');
                    this.currentPage="HostAnswerReveal";
                } else {
                    this.playQuestionPosition = 0;
                    this.sendPlayersPage('PlayLeaderBoard');
                    this.currentPage="HostLeaderBoard";
                }
            },

            showAnswer() {
                this.revealAnswerToPlayers();
                // axios.post('/api/host/game/'+ this.gameCode.code +'/question/'+ this.questionPosition +'/revealAnswer');

                this.revealAnswer = true;
            }
        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('host', ['roundPosition', 'questionPosition', 'page']),
            playRoundPosition: {
                get() {
                    return this.roundPosition;
                },
                set(value) {
                    return this.$store.commit('host/SET_ROUND_POSITION', value);
                }
            },
            playQuestionPosition: {
                get() {
                    return this.questionPosition;
                },
                set(value) {
                    return this.$store.commit('host/SET_QUESTION_POSITION', value);
                }
            },
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('host/SET_PAGE', value);
                }
            }
        },
        watch: {
            playQuestionPosition: function() {
                this.decideUpNext();
            }
        }
    }
</script>

<style scoped>

</style>
