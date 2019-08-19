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
                    <div v-if="this.timer === 0">
                        <button type="button" class="btn btn-success btn-lg mr-2" @click='onUpNext()'>Up Next: {{upNext}}</button>
                    </div>
                    <div v-else>
                        <h4>Time Left: {{this.timer}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12 text-center pt-5">
                <h1> {{this.questions[this.playQuestionPosition].title}}</h1>
            </div>
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
            this.startTimer();
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
            }
        },
        computed: {
            ...mapGetters('question', ['questions']),
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