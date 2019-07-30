<template>
    <div>
        <div class="row no-gutters">
            <div class="col-md-4">

            </div>
            <div class="col-md-8">
                <RoundIndex></RoundIndex>
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
            //sets the value of id to the id of the game that was created
            this.id = this.$route.params;

            //fetches the information of the game to load it into the details
            this.fetchData(this.id);

            this.fetchRounds(this.id);
            this.round_game_id = this.game_id;
            // this.round_type = 'play';

            //for Questions
            this.fetchQuestions(this.id.id);

            //for Answers
            this.fetchAnswers(this.id.id);

            // document.querySelector('body').style.backgroundColor = '#EFFAF3';

        },
        methods:{
            ...mapActions('game', ['fetchData']),
            ...mapActions('round', ['deleteRound', 'fetchRounds']),
            ...mapActions('question', ['fetchQuestions','deleteQuestion']),
            ...mapActions('answer', ['fetchAnswers','deleteQuestion']),
            delete_Round() {
                this.deleteRound();
                this.$bvModal.hide("delete-round");
            },
            delete_Question() {
                this.deleteQuestion();
                this.$bvModal.hide("delete-question");
            },

        },
        computed: {
            ...mapGetters('game', ['game', 'game_id']),
            ...mapGetters('round', ['rounds','formGameID']),
            ...mapGetters('question', ['questions', 'loaded']),
            questionLoaded: {
                get() {
                    return this.loaded;
                }
            },
            gameRounds: {
                get() {
                    return this.rounds;
                }
            },
            round_game_id: {
                get() {
                    return this.formGameID;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_GAME_ID', value);
                }
            }
        },
        watch: {
            game: function () {
                document.querySelector('body').style.backgroundColor = this.game.bodyColor;
            }
        }
    }
</script>

<style scoped>

</style>