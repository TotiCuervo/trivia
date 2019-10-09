<template>
    <div>
        <div class="row pt-4 text-center">
            <div class="col-md-12">
                <h2 style="font-size:5rem">Round</h2>
            </div>
            <div class="col-md-12">
                <h2 style="font-size:5rem">{{this.rounds[this.playRoundPosition].order_number}}</h2>
            </div>

        </div>
        <div class="row pb-3 pt-5" v-if="this.rounds[this.playRoundPosition].title">
            <div class="col-md-12 text-center">
                <transition name="fade">
                    <h2 v-if="show_description">{{this.rounds[this.playRoundPosition].title}}</h2>
                </transition>
            </div>
        </div>
        <div class="row pt-1">
            <div class="col-md-12 text-center">
                <transition name="fade">
                    <h2 v-if="show_time && this.rounds[this.playRoundPosition].time">{{this.rounds[this.playRoundPosition].time}} second questions</h2>
                    <h2 v-if="show_time && !this.rounds[this.playRoundPosition].time">No Time Limit</h2>
                </transition>

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
