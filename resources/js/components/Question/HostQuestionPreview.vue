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

                <h1>Round {{this.rounds[roundPosition].order_number}} Question {{this.questions[questionPosition].order_number}}</h1>
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

                        console.log('hit');
                        axios.post('/api/host/'+ vm.gameCode.code + '/round/'+ vm.roundPosition + '/startQuestion/' +vm.questionPosition)
                            .then(response => {
                                console.log(response.data);

                            });

                        vm.$emit('goToDestination', vm.roundPosition, vm.questionPosition, 'HostQuestion');
                    }
                    // clearInterval(timer);
                }, 100);
            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('game', ['gameCode'])


        },
        props: ['roundPosition','questionPosition']
    }
</script>

<style scoped>

</style>