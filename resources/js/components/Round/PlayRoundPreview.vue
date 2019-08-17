<template>
    <div>
        <div class="row pt-4">
            <div class="col-md-12 text-center">
                <h1>Round {{this.rounds[this.playRoundPosition].order_number}}</h1>
            </div>
        </div>
        <div class="row pb-3 pt-3" v-if="this.rounds[this.playRoundPosition].title">
            <div class="col-md-12 text-center">
                <h1>{{this.rounds[this.playRoundPosition].title}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 v-if="this.rounds[this.playRoundPosition].time">{{this.rounds[this.playRoundPosition].time}} seconds per Questions</h1>
                <h1 v-else>No Time Limit</h1>
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

        },
        methods: {
            // upNext() {
            //     let questionPosition = '';
            //
            //     for (let $i=0; $i < this.questions.length; $i++) {
            //         if (this.questions[$i].round_id === this.rounds[this.roundPosition].id && this.questions[$i].order_number === 1) {
            //             questionPosition = $i;
            //         }
            //     }
            //     this.$emit('goToDestination', this.roundPosition, questionPosition, 'HostQuestionPreview');
            // },
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