<template>
    <div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Round Review</h3>
                <div class="float-right">
                    <button type="button" class="btn btn-success btn-lg mr-2" @click='startAnswerReveal()'>Up Next: Question 1 Answer</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>This is the round review. stay tuned for more</h1>
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
            axios.post('/api/host/' + this.gameCode.code + '/roundReview')
                .then(response => {

                });
        },
        methods: {
            startAnswerReveal() {
                for (let $i=0; $i < this.questions.length; $i++) {
                    if (this.questions[$i].round_id === this.rounds[this.playRoundPosition].id && this.questions[$i].order_number === 1) {
                        this.playQuestionPosition = $i;
                    }
                }

                axios.post('/api/host/' + this.gameCode.code + '/round/'+ this.playRoundPosition + '/question/' + this.playQuestionPosition + '/currentPage/'+'PlayRevealAnswer')
                    .then(response => {

                    });
                this.currentPage = 'HostAnswerReveal';
            }
        },
        computed: {
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('round', ['rounds']),
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