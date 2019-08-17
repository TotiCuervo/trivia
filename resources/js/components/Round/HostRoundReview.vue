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
                let questionPosition = '';
                for (let $i=0; $i < this.questions.length; $i++) {
                    if (this.questions[$i].round_id === this.rounds[this.roundPosition].id && this.questions[$i].order_number === 1) {
                        questionPosition = $i;
                    }
                }

                axios.post('/api/host/' + this.gameCode.code + '/round/'+ this.roundPosition + '/question/' + questionPosition + '/currentPage/'+'PlayRevealAnswer')
                    .then(response => {

                    });
                this.$emit('goToDestination', this.roundPosition, questionPosition, 'HostAnswerReveal');
            }
        },
        computed: {
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('round', ['rounds'])
        },
        props: ['roundPosition']
    }
</script>

<style scoped>

</style>