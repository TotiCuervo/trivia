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
                <h1> {{this.questions[questionPosition].title}}</h1>
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
                        if (vm.questionPosition + 1 === vm.questions.length) {
                            vm.upNext = 'Round ' + vm.rounds[vm.roundPosition].order_number + ' Review'
                        } else {
                            if (vm.questions[vm.questionPosition + 1].round_id === vm.rounds[vm.roundPosition].id) {
                                vm.upNext = 'Question ' + vm.questions[vm.questionPosition + 1].order_number;
                                vm.newQuestionPosition = vm.questionPosition + 1;
                            } else {
                                vm.upNext = 'Round ' + vm.rounds[vm.roundPosition].order_number + ' Review'
                            }
                        }
                    }
                }, 1000);
            },
            onUpNext() {
                if (this.newQuestionPosition !== "") {
                    this.$emit('goToDestination', this.roundPosition, this.newQuestionPosition, 'HostQuestionPreview')
                } else {
                    this.$emit('goToDestination', this.roundPosition, 0, 'HostRoundReview');
                }
            }
        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('round', ['rounds'])
        },
        props: ['questionPosition', 'roundPosition']
    }
</script>

<style scoped>

</style>