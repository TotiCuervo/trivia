<template>
    <span class="mb-0 float-left flex-grow-1 flex-sm-grow-0 float-md-0" v-b-tooltip.left title='Stopwatch for this question' tabindex="0"><span class="h4"><i class="fas fa-stopwatch"></i></span> <span class="h5"> {{this.timer}}</span></span>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {

            }
        },
        mounted() {
            this.$store.commit('play/UPDATE_TIMER', 2);
            // this.timer = this.rounds[this.playRoundPosition].time;
            this.startTimer();
        },
        methods: {

            startTimer() {

                let vm = this;

                setTimeout(function () {

                    vm.$store.commit('play/UPDATE_TIMER', vm.timer - 1);

                    // vm.timer = vm.timer - 1;

                    if (vm.timer !== 0) {

                        vm.startTimer();

                    }
                }, 1000);
            },
        },
        computed: {
            ...mapGetters('play', ['timer']),
        },
    }
</script>

<style scoped>

</style>
