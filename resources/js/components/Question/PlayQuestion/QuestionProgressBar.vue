<template>
    <div>
        <!--Progress Bar-->
        <div class="row no-gutters" v-if="this.rounds[roundPosition].time">
            <div class="col-md-12">
                <b-progress height="8px" :max="max">
                    <b-progress-bar :value="time" :variant="variantColor">
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