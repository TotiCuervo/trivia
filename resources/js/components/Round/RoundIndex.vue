<template>
    <div>

        <!--wait until the rounds have been loaded-->
        <div v-if="!(this.id == null)">
            <!--if there are no rounds, show this-->
            <div class="row pb-4" v-if="this.rounds.length === 0">
                <div class="col-md-12">
                    Add a round now!
                </div>
            </div>
            <draggable v-model="game_rounds" v-else>
                <div class="row no-gutters pb-3" v-for="round in game_rounds" :key="round.id">
                    <div class="pr-2 pl-2 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
                        <RoundDetails :round="round"></RoundDetails>
                    </div>
                </div>
            </draggable>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                id: null,
            }
        },
        mounted() {
            this.id = this.$route.params;



            // //for Rounds
            // this.fetchRounds(this.id);
            //
            // this.round_game_id = this.game_id;
            //
            // //for Questions
            // this.fetchQuestions(this.id.id);
            //
            // //for Answers
            // this.fetchAnswers(this.id.id);

            // this.organizeByOrderNumber();
        },
        methods:{
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('question', ['fetchQuestions']),
            ...mapActions('answer', ['fetchAnswers']),
        },
        computed: {
            ...mapGetters('game', ['game_id']),
            ...mapGetters('round', ['rounds', 'formGameID','formRoundType']),
            ...mapGetters('question', ['questions']),
            game_rounds: {
                get() {
                    return this.rounds;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_LIST', value);
                }
            },
            round_game_id: {
                get (){
                    return this.formGameID;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_GAME_ID', value);
                }
            },
            round_type: {
                get (){
                    return this.formRoundType;
                },
                set (value) {
                    this.$store.commit('round/UPDATE_ROUND_TYPE', value);
                }
            },
        }
    }
</script>

<style scoped>

</style>
