<template>
    <div>
        <!--Progress Bar-->
        <div class="row no-gutters" v-if="this.rounds[roundPosition].time">
            <div class="col-md-12">
                <b-progress height="8px" :max="max">
                    <b-progress-bar :value="timer" :variant="variantColor">
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

            }
        },
        mounted() {
            this.$store.commit('time/UPDATE_TIMER', this.rounds[this.roundPosition].time);
            this.setUpTimer(this.rounds[this.roundPosition].time);
            this.startTimer();

            // Echo.join('game.'+this.team.gameCode)
            //     .listen('StartQuestion', (e) => {
            //         this.variantColor = 'success';
            //         this.endQuestion = false;
            //         this.answer = '';
            //         this.startTimer();
            //     })
            //     .listen('UpdateTime', (e) => {
            //         if (Number(e.teamID) === this.team.id) {
            //             this.time = parseInt(e.time);
            //         }
            //     });

        },
        methods: {
            ...mapActions('time', ['setUpTimer']),
            startTimer() {
                let vm = this;
                this.stopWatch = setInterval(function() {
                    vm.$store.commit('time/UPDATE_TIMER', vm.timer - 1);
                    // vm.timer -= 1;

                    if (vm.stopWatch <= vm.yellowTime && vm.time > vm.redTime) {
                        vm.$store.commit('time/SET_VARIANT_COLOR', 'warning');
                        // vm.variantColor = 'warning';
                    }

                    if (vm.timer <= vm.redTime) {
                        vm.$store.commit('time/SET_VARIANT_COLOR', 'danger');

                        // vm.variantColor = 'danger';
                    }

                    if (vm.timer === -1) {
                        clearInterval(vm.stopWatch);

                        vm.$emit('endTheQuestion');
                    }
                }, 1000);
            },

        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('team', ['team']),
            ...mapGetters('time', ['timer', 'max', 'variantColor', 'yellowTime', 'redTime']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
        },
        watch: {
            questionPosition: function () {
                this.$store.commit('time/UPDATE_TIMER', this.rounds[this.roundPosition].time);
                this.$store.commit('time/SET_VARIANT_COLOR', 'success');
                clearInterval(this.stopWatch);
                this.startTimer();
            },

        }

    }
</script>

<style scoped>

</style>
