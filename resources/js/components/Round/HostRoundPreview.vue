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
                <h1>Round {{this.rounds[roundPosition].order_number}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 v-if="this.rounds[roundPosition].time">{{this.rounds[roundPosition].time}}s Questions</h1>
                <h1 v-else>No Time Limit</h1>
            </div>
        </div>
        <div class="row">
            <div class v-for="question in this.questions">
                <div class="col-md-12 pt-5" v-if="question.round_id === rounds[roundPosition].id">
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
            axios.post('/api/host/'+ this.gameCode.code + '/startRound/' +this.roundPosition)
                .then(response => {
                   console.log(response.data);
                });

        },
        methods: {
            upNext() {
                let questionPosition = '';

                for (let $i=0; $i < this.questions.length; $i++) {
                    if (this.questions[$i].round_id === this.rounds[this.roundPosition].id && this.questions[$i].order_number === 1) {
                        questionPosition = $i;
                    }
                }
                this.$emit('goToDestination', this.roundPosition, questionPosition, 'HostQuestionPreview');
            },
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('game', ['gameCode']),
        },
        props: ['roundPosition']
    }
</script>

<style scoped>

</style>