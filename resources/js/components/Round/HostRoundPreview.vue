<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="button" class="btn btn-success btn-lg mr-2" @click='upNext()'>Question 1</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Round {{this.rounds[this.playRoundPosition].order_number}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 v-if="this.rounds[this.playRoundPosition].time">{{this.rounds[this.playRoundPosition].time}}s Questions</h1>
                <h1 v-else>No Time Limit</h1>
            </div>
        </div>
        <div class="row">
            <div class v-for="question in this.questions">
                <div class="col-md-12 pt-5" v-if="question.round_id === rounds[playRoundPosition].id">
                    <h3>{{question.order_number}}. {{question.title}}</h3>
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

            }
        },
        mounted() {
            axios.post('/api/host/'+ this.gameCode.code + '/startRound/' +this.playRoundPosition)
                .then(response => {
                   console.log(response.data);
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