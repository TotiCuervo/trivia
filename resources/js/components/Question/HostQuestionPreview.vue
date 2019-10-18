<template>
    <div>
        <!--Sub header-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center justify-content-sm-between">
                    <!--float-left-->
                    <span class="mb-0 float-left flex-grow-1 flex-sm-grow-0 float-md-0"><span class="h4"><i class="fas fa-stopwatch"></i></span> <span class="h5"> {{this.timer}}</span></span>
                    <!--stays in center-->
                    <h6 class="mb-0 d-none d-sm-flex" v-if="this.questions[this.playQuestionPosition].type === 'Fill-in-blank'"> Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}} Fill In The Blank </h6>
                    <h6 class="mb-0 d-none d-sm-flex" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'"> Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}} Multiple Choice </h6>

                    <!--float-right-->
                    <b-button class="float-right" disabled pill variant="primary">Loading....</b-button>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-6 offset-md-3">
                <TeamAnswerCount></TeamAnswerCount>
            </div>
        </div>
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
        <div class="row pt-5">
            <div class="col-md-6 offset-md-3">
                <b-progress height="3rem" :max="max" :striped=true :animated=true>
                    <b-progress-bar :value="value" variant="success">
                    </b-progress-bar>
                </b-progress>
            </div>
        </div>
        <div class="row pt-1">
            <div class="col-12 text-center">
                <h6>(Players will see question when loading is done)</h6>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                // timer: 4,
                // value: 0
                timer: 0,
                value: 0,
                max: 180
            }
        },
        mounted() {
            this.startTimer();
        },
        methods: {
            startTimer() {
                let vm = this;
                let timer = setInterval(function() {
                    vm.value += 6;
                    if (vm.value >= 240) {
                        clearInterval(timer);

                        axios.post('/api/host/'+ vm.gameCode.code + '/round/' + vm.playRoundPosition +'/question/' + vm.playQuestionPosition + '/currentPage/' + 'PlayQuestion')
                            .then(response => {
                                // console.log(response.data);
                            });
                        vm.currentPage = 'HostQuestion';
                    }
                }, 100);
            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
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
