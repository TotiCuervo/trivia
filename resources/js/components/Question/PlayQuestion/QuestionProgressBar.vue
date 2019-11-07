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
        <div class="row no-gutters" v-if="this.rounds[roundPosition].time">
            <div class="col-md-12">
                {{timer}}
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
            console.log('hitting timer update function');
            this.$store.commit('time/UPDATE_TIMER', this.rounds[this.roundPosition].time);
            // this.$store.commit('time/SET_VARIANT_COLOR', 'success');
            this.setUpTimer(this.rounds[this.roundPosition].time);
            this.startTimer();

        },
        methods: {
            ...mapActions('time', ['setUpTimer']),
            startTimer() {
                let vm = this;
                this.stopWatch = setInterval(function() {
                    vm.$store.commit('time/UPDATE_TIMER', vm.timer - 1);
                    console.log('hitting  startTimer deincrement');


                    if (vm.stopWatch <= vm.yellowTime && vm.time > vm.redTime) {
                        vm.$store.commit('time/SET_VARIANT_COLOR', 'warning');
                    }

                    if (vm.timer <= vm.redTime) {
                        vm.$store.commit('time/SET_VARIANT_COLOR', 'danger');
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
        beforeDestroy() {
            clearInterval(this.stopWatch);
            this.$store.commit('time/SET_VARIANT_COLOR', 'success');

        },
        watch: {
            questionPosition: function () {
                console.log('hitting questionPosition watcher');
                this.$store.commit('time/UPDATE_TIMER', this.rounds[this.roundPosition].time);
                this.$store.commit('time/SET_VARIANT_COLOR', 'success');
                clearInterval(this.stopWatch);
                this.setUpTimer(this.rounds[this.roundPosition].time);
                this.startTimer();
            },

        }

    }
</script>

<style scoped>

</style>
