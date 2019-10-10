<template>
    <div class="row pt-5" v-if="this.time !== 0">
        <div class="col-12 text-center">
            <h1 class="m-0" v-if="variantColor === 'warning'">༼ つ ◕_◕ ༽つ</h1>
            <h1 class="m-0" v-if="variantColor === 'danger'">༼ つ ಥ_ಥ ༽つ</h1>
            <h5 class="m-0" v-if="variantColor === 'warning'">You need to hurry</h5>
            <h5 class="m-0" v-if="variantColor === 'danger'">Seriously, please hurry.</h5>

        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    //THROW AWAY
    export default {
        data() {
            return {
                time: 0,
                max: 0,
                timer: '',
                variantColor: 'success',
                yellowTime: '',
                redTime: '',
            }
        },
        mounted() {
            this.startTimer();

            Echo.join('game.'+this.team.gameCode)
                .listen('StartQuestion', (e) => {
                    console.log('just got new question');
                    this.variantColor = 'success';
                    this.endQuestion = false;
                    this.answer = '';
                    this.startTimer();
                })
                .listen('UpdateTime', (e) => {
                    if (Number(e.teamID) === this.team.id) {
                        this.time = parseInt(e.time);
                    }
                });

        },
        methods: {
            startTimer() {
                this.time = this.rounds[this.roundPosition].time;
                this.max = this.rounds[this.roundPosition].time;
                this.yellowTime = (this.rounds[this.roundPosition].time/3) + (this.rounds[this.roundPosition].time/3);
                this.redTime = this.rounds[this.roundPosition].time/3;
                let vm = this;
                this.timer = setInterval(function() {
                    vm.time -= 1;

                    if (vm.time <= vm.yellowTime && vm.time > vm.redTime) {
                        vm.variantColor = 'warning';
                    }

                    if (vm.time <= vm.redTime) {
                        vm.variantColor = 'danger';
                    }

                    if (vm.time === -1) {
                        clearInterval(vm.timer);

                        vm.$emit('endTheQuestion');
                        // vm.endQuestion = true;
                        // this.submitAnswer();
                    }
                }, 1000);
            },
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('team', ['team']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
        },
        watch: {
            questionPosition: function () {
                this.variantColor = "success";
                clearInterval(this.timer);
                this.startTimer();
            },

        }

    }
</script>

<style scoped>

</style>
