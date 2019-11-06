<template>
    <div class="row pt-4 text-center justify-content-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="tf animated fadeInLeft" style="font-size:5rem">Round {{this.rounds[this.playRoundPosition].order_number}}</h2>
                </div>
            </div>
            <div class="row pt-3" v-if="this.rounds[this.playRoundPosition].title">
                <div class="col-md-12 text-center">
                    <transition name="fade">
                        <h3 v-if="show_description">"{{this.rounds[this.playRoundPosition].title}}"</h3>
                    </transition>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-md-8 offset-md-2 text-center">
                    <transition name="fade2">
                                    <span v-if="show_time">
                                        <span><i class="fas fa-stopwatch fa-2x"></i></span>
                                        <span class="h5 ml-3 mt-2" v-if="this.rounds[this.playRoundPosition].time">{{this.rounds[this.playRoundPosition].time}} second questions</span>
                                        <span class="h5 ml-3 mt-2" v-if="!this.rounds[this.playRoundPosition].time">No Time Limit</span>
                                    </span>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                show_description: false,
                show_time: false,

            }
        },
        mounted() {

            let vm = this;
            setTimeout(function(){
                vm.show_description = true;
            }, 1000);

            setTimeout(function(){
                vm.show_time = true;
            }, 2000);

        },
        methods: {

        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            ...mapGetters('user', ['darkMode']),

            playRoundPosition: {
                get() {
                    return this.roundPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_ROUND_POSITION', value);
                }
            },
        },
    }
</script>

<style scoped>

</style>
