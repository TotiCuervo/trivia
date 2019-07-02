<template>
    <div>
        <div v-if="!(this.id == null)">
            <div v-if="this.rounds.length === 0">
                <div class="row pb-4">
                    <div class="col-md-12">
                        Add a round now!
                    </div>
                </div>
            </div>
            <div v-else>
                <div v-for="round in this.rounds" class="round-row pb-5">
                    <div class="row pb-3">
                        <div class="col-md-12">
                            <h4 class="float-left">Round: {{round.order_number}}</h4>
                            <div class="float-right">
                                <p>xxx</p>
                            </div>
                        </div>
                    </div>
                    <QuestionIndex :round_id="round.id"></QuestionIndex>

                    <div class="row pt-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success">
                                <router-link :to="{ name: 'qaForm', params: { id: id.id, round_id: round.id } }" class="nav-link"><span style="color:white">Add Question</span></router-link>
                            </button>
                            <hr>
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

            //for Rounds
            this.fetchRounds(this.id);
            this.game_id = this.trivia_id;
            this.round_type = 'play';

            //for Questions
            this.fetchQuestions(this.id.id);

            //for Answers
            this.fetchAnswers(this.id.id);
        },
        methods:{
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('question', ['fetchQuestions']),
            ...mapActions('answer', ['fetchAnswers']),

        },
        computed: {
            ...mapGetters('game', ['trivia_id', 'trivia']),
            ...mapGetters('round', ['rounds', 'formGameID','formRoundType']),
            game_id: {
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