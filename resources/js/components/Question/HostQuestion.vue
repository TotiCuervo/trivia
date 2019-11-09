<template>
    <div>
        <!--Sub header-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center justify-content-sm-between">
                    <!--float-left-->
                    <QuestionTimer></QuestionTimer>

                    <!--stays in center-->
                    <h6 class="mb-0 d-none d-sm-flex" v-if="this.questions[this.playQuestionPosition].type === 'Fill-in-blank'"> Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}} Fill In The Blank </h6>
                    <h6 class="mb-0 d-none d-sm-flex" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'"> Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}} Multiple Choice </h6>

                    <!--float-right-->
                    <b-button pill class="float-right" variant="primary" v-if="this.timer === 0" @click='onUpNext()'>{{upNext}}</b-button>
                    <b-button disabled pill class="float-right" variant="primary" v-if="this.timer !== 0">{{upNext}}</b-button>
                </div>
            </div>
        </div>
        <!--Team Answer Count-->
        <div class="row pt-4">
            <div class="col-md-6 offset-md-3">
                <TeamAnswerCount></TeamAnswerCount>
            </div>
        </div>
        <!--Question Title-->
        <div class="row">
            <div class="col-md-6 offset-md-3 pt-2">
                <HostQuestionCard></HostQuestionCard>
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
                upNext: '',
                newQuestionPosition: '',
            }
        },
        mounted() {

            this.decideUpNext();

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
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('host', ['roundPosition', 'questionPosition', 'page', 'timer']),
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
    }
</script>

<style scoped>

</style>
