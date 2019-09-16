<template>
    <div>
        <!--Navigation-->
        <div class="row">
            <div class="col-5">
                <div class="float-left">
                    <small>Round {{this.rounds[this.playRoundPosition].order_number}}</small>
                    <p class="mb-0">Question {{this.questions[this.playQuestionPosition].order_number}}</p>
                    <h6 class="mb-0">{{this.questions[this.playQuestionPosition].type}}</h6>
                    <h5 class="pt-2 mb-0" id="answer-popover" @click="$bvToast.show('example-toast')">0/8 Answers</h5>
                </div>
            </div>
            <div class="col-7">
                <div class="float-right">
                    <div v-if="this.timer === 0">
                        <button type="button" class="btn btn-success btn-lg mr-2" @click='onUpNext()'>{{upNext}}</button>
                    </div>
                    <div v-else>
                        <h4>Time Left: {{this.timer}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <!--Question Title-->
        <div class="row pt-5">
            <div class="col-md-12 text-center pt-5">
                <h2>{{this.questions[this.playQuestionPosition].title}}</h2>
            </div>
        </div>
        <!--Multiple Choice Answers Optional-->
        <div class="pt-3" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'">
            <HostMultipleChoiceAnswerOptions></HostMultipleChoiceAnswerOptions>
        </div>
        <div class="pt-5">
            <HostTeamAnswerPool></HostTeamAnswerPool>
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

            // this.timer = this.rounds[this.playRoundPosition].time;

            this.startTimer();

            Echo.join('game.'+this.gameCode.code)
                .listen('NewTeam', (e) => {

                    if (this.currentPage === 'HostQuestion') {
                        console.log('made it to Host Question NewTeam:');
                        console.log('sending PlayQuestion');

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
            startTimer() {

                let vm = this;

                setTimeout(function () {

                    vm.timer = vm.timer - 1;

                    if (vm.timer !== 0) {

                        vm.startTimer();

                    } else {
                        if (vm.playQuestionPosition + 1 === vm.questions.length) {
                            vm.upNext = 'Round ' + vm.rounds[vm.playRoundPosition].order_number + ' Review'
                        } else {
                            if (vm.questions[vm.playQuestionPosition + 1].round_id === vm.rounds[vm.playRoundPosition].id) {
                                vm.upNext = 'Question ' + vm.questions[vm.playQuestionPosition + 1].order_number;
                                vm.newQuestionPosition = vm.playQuestionPosition + 1;
                            } else {
                                vm.upNext = 'Round ' + vm.rounds[vm.playRoundPosition].order_number + ' Review'
                            }
                        }
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
            teamAnswerPoolToast() {
                this.$bvToast.toast(`Team Answer Pool`, {
                    title: `b-toaster-bottom-center`,
                    toaster: toaster,
                    solid: true,
                    appendToast: append
                })
            }
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