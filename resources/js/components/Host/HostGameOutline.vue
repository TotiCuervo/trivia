<template>
    <div>
        <HostRoundIndex :rounds="rounds" :questions="questions" :answers="answers"></HostRoundIndex>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                params: '',
            }
        },
        mounted() {
            //sets the value of id to the id of the game that was created
            this.params = this.$route.params;

            //fetches the information of the game to load it into the details
            this.fetchData(this.params);

            this.fetchRounds(this.params);

            //for Questions
            this.fetchQuestions(this.params.id);

            //for Answers
            this.fetchAnswers(this.params.id);

        },
        methods:{
            ...mapActions('game', ['fetchData']),
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('question', ['fetchQuestions']),
            ...mapActions('answer', ['fetchAnswers']),
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id']),
            ...mapGetters('round', ['rounds','formGameID']),
            ...mapGetters('question', ['questions', 'loaded']),
            ...mapGetters('answer', ['answers']),
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
    }
</script>

<style scoped>

</style>