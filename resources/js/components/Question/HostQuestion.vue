<template>
    <div>
        <!--Sub header-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center justify-content-sm-between">
                    <!--float-left-->
<!--                    <h6 class="mb-0 float-left flex-grow-1 flex-sm-grow-0 float-md-0"><i class="fas fa-stopwatch"></i>: {{this.timer}}</h6>-->
                    <span class="mb-0 float-left flex-grow-1 flex-sm-grow-0 float-md-0" v-b-tooltip.left title='Stopwatch for this question' tabindex="0"><span class="h4"><i class="fas fa-stopwatch"></i></span> <span class="h5"> {{this.timer}}</span></span>

                    <!--stays in center-->
                    <h6 class="mb-0 d-none d-sm-flex" v-if="this.questions[this.playQuestionPosition].type === 'Fill-in-blank'"> Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}} Fill In The Blank </h6>
                    <h6 class="mb-0 d-none d-sm-flex" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'"> Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}} Multiple Choice </h6>

                    <!--float-right-->
                    <b-button pill class="float-right" variant="primary" v-if="this.timer === 0" @click='onUpNext()'>{{upNext}}</b-button>
                    <b-button disabled pill class="float-right" variant="primary" v-if="this.timer !== 0">{{upNext}}</b-button>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-6 offset-md-3">
                <TeamAnswerCount></TeamAnswerCount>
            </div>
        </div>
        <!--Question Title-->
        <div class="row">
            <div class="col-md-6 offset-md-3 pt-2">
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
        <!--Multiple Choice Answers Optional-->
        <div class="pt-3 pb-3" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'">
            <HostMultipleChoiceAnswerOptions></HostMultipleChoiceAnswerOptions>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                timer: 2,
                upNext: '',
                newQuestionPosition: '',
            }
        },
        mounted() {

            this.timer = this.rounds[this.playRoundPosition].time;
            this.decideUpNext();
            this.startTimer();

            Echo.join('game.'+this.gameCode.code)
                .listen('NewTeam', (e) => {

                    if (this.currentPage === 'HostQuestion') {
                        // console.log('made it to Host Question NewTeam:');
                        // console.log('sending PlayQuestion');

                        axios.post('/api/host/'+ this.gameCode.code + '/round/' + this.playRoundPosition +'/question/' + this.playQuestionPosition + '/currentPage/' + 'PlayQuestion')
                            .then (response => {
                                console.log('sending this time:');
                                console.log(this.timer);

                                axios.post('/api/host/'+ this.gameCode.code + '/team/' + e.team.id +'/time/'+this.timer)
                            });
                    }

                });
        },
        methods: {
            decideUpNext() {
                if (this.playQuestionPosition + 1 === this.questions.length) {

                    this.upNext = 'Round ' + this.rounds[this.playRoundPosition].order_number + ' Review'

                } else {

                    if (this.questions[this.playQuestionPosition + 1].round_id === this.rounds[this.playRoundPosition].id) {

                        this.upNext = 'Question ' + this.questions[this.playQuestionPosition + 1].order_number;
                        this.newQuestionPosition = this.playQuestionPosition + 1;

                    } else {

                        this.upNext = 'Round ' + this.rounds[this.playRoundPosition].order_number + ' Review'

                    }

                }
            },
            startTimer() {

                let vm = this;

                setTimeout(function () {

                    vm.timer = vm.timer - 1;

                    if (vm.timer !== 0) {

                        vm.startTimer();

                    }
                }, 1000);
            },
            onUpNext() {
                if (this.newQuestionPosition !== "") {
                    this.playQuestionPosition = this.newQuestionPosition;
                    this.currentPage = 'HostQuestionPreview';
                } else {
                    this.playQuestionPosition = 0;
                    this.currentPage = 'HostRoundReview';
                }
            },
        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('round', ['rounds']),
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
