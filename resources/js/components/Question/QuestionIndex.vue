<template>
    <div>
        <!--<div class="row pb-5" v-for="i in Math.ceil(questions.length / 3)">-->
            <!--<div v-for="question in questions.slice((i-3)*3,i*3)">-->
                <!--<div v-if="question.round_id === round_id">-->
                    <!--<div class="col-md-12 pr-2">-->
                        <!--<div class="card">-->
                            <!--<div class="card-body">-->
                                <!--<h4>{{question.title}}</h4>-->
                                <!--<AnswerIndex :question_id="question.id"></AnswerIndex>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->

        <div class="container">
            <div v-for="question in questions">
                <div v-if="question.round_id === round_id">
                    <div class="row pb-3">
                        <div class="col-md-12 pr-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <h5>Q1</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <h4>{{question.title}}</h4>
                                        </div>
                                        <div class="col-md-5">
                                            <AnswerIndex :question_id="question.id"></AnswerIndex>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            // this.fetchQuestions(this.id.id);
        },
        methods: {
            ...mapActions('question', ['fetchQuestions']),
        },
        computed: {
            ...mapGetters('question', ['questions']),
        },
        props: ['round_id'],
    }
</script>

<style scoped>

</style>