<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-left">
                    <b-button pill variant="outline-primary" @click='goToStartGame()'>Select Round</b-button>
                </div>
                <div class="float-right">
                    <b-button pill variant="primary" @click='upNext()'>Question 1</b-button>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-12 text-center">
                <h3>Round {{this.rounds[this.playRoundPosition].order_number}}</h3>
            </div>
        </div>
        <div class="row pb-2">
            <div class="col-md-12 text-center">
                <h3 v-if="this.rounds[this.playRoundPosition].time">{{this.rounds[this.playRoundPosition].time}}s Questions</h3>
                <h3 v-else>No Time Limit</h3>
            </div>
        </div>
        <div class="row pt-3" v-for="question in this.questions">
            <div class="col-md-12 text-center" v-if="question.round_id === rounds[playRoundPosition].id">
                <h3>{{question.order_number}}. {{question.title}}</h3>
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

            axios.post('/api/host/'+ this.gameCode.code + '/round/' + this.playRoundPosition +'/question/' + this.playQuestionPosition + '/currentPage/' + 'PlayRoundPreview')
                .then(response => {
                    // consolex.log(response.data);
                });

        },
        methods: {
            upNext() {
                for (let $i=0; $i < this.questions.length; $i++) {
                    if (this.questions[$i].round_id === this.rounds[this.playRoundPosition].id && this.questions[$i].order_number === 1) {
                        this.playQuestionPosition = $i;
                    }
                }
                this.currentPage = 'HostQuestionPreview';
            },
            goToStartGame() {
                this.currentPage = 'HostStartGame';
            }
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
            playQuestionPosition: {
                get() {
                    return this.questionPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_QUESTION_POSITION', value);
                }
            },
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            }
        },
    }
</script>

<style scoped>

</style>
