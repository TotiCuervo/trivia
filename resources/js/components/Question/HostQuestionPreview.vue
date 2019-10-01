<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <div class="float-left">
                        <p class="mb-0">Round {{this.rounds[this.playRoundPosition].order_number}}</p>
                        <p class="mb-0">Question {{this.questions[this.playQuestionPosition].order_number}}</p>
                        <p class="mb-0" v-if="this.questions[this.playQuestionPosition].type === 'Multiple-Choice'">Multiple Choice</p>
                        <p class="mb-0" v-if="this.questions[this.playQuestionPosition].type === 'Fill-in-blank'">Fill In The Blank</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-8 offset-md-2">
                <TeamAnswerCount></TeamAnswerCount>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 pt-2">
                <div class="hostQuestion-card card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="small text-muted">Round {{this.rounds[this.playRoundPosition].order_number}} / Question {{this.questions[this.playQuestionPosition].order_number}} / {{this.questions[this.playQuestionPosition].type}}</span>
                            </div>
                        </div>
                        <div class="row p-5">
                            <div class="col-md-12 text-center">
                                <h2 class="m-0">{{this.questions[this.playQuestionPosition].title}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <b-progress height="3rem" :max="max" :striped=true :animated=true>
                    <b-progress-bar :value="value" variant="success">
                    </b-progress-bar>
                </b-progress>
            </div>
        </div>
        <div class="row pt-1">
            <div class="col-12 text-center">
                <h4>(Players will see question when loading is done)</h4>
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
