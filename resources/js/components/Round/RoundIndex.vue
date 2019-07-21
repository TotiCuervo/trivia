<template>
    <div>

        <!--wait until the rounds have been loaded-->
        <div v-if="!(this.id == null)">

            <!--if there are no rounds, show this-->
            <div v-if="this.rounds.length === 0">
                <div class="row pb-4">
                    <div class="col-md-12">
                        Add a round now!
                    </div>
                </div>
            </div>
            <!--else, do this-->
            <div v-else>
                <div class="row no-gutters">
                    <div class="col-md-8 offset-md-2">
                        <!--for every round that there is, create a new round component-->
                        <div v-for="round in this.rounds" class="round-row pb-5">
                            <RoundDetails :round="round"></RoundDetails>
                        </div>
                    </div>
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