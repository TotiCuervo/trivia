<template>
    <div>
        <!--<div class="row">-->
            <!--<div class="col-md-12 text-center">-->
                <!--<h1>Question {{this.questions[questionPosition].order_number}} will begin in: {{this.timer}} </h1>-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="row">-->
            <!--<div class="col-md-12 text-center pt-5">-->
                <!--<h2> {{this.questions[questionPosition].title}}</h2>-->
            <!--</div>-->
        <!--</div>-->
        <div class="row pt-5">
            <div class="col-md-12 text-center pt-5">

                <h1>Round {{this.rounds[this.playRoundPosition].order_number}} Question {{this.questions[this.playQuestionPosition].order_number}}</h1>
                <h1>Starts in: {{this.timer}}</h1>
                <b-progress height="3rem" :max="max" :striped=true :animated=true>
                    <b-progress-bar :value="value" variant="success">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 v-if="value > 10">Loading</h5>
                            </div>
                        </div>
                    </b-progress-bar>
                </b-progress>
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
                        axios.post('/api/host/'+ vm.gameCode.code + '/round/'+ vm.playRoundPosition + '/startQuestion/' +vm.playQuestionPosition)
                            .then(response => {
                                console.log(response.data);

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