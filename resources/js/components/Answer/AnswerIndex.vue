<template>
    <div>
        <!--<div v-for="answer in answers">-->
            <!--<div v-if="answer.question_id === question.id">-->
                <!--<div class="row">-->
                    <!--<div v-if="question.type === 'Multiple-Choice'">-->
                        <!--<table style="height: 100%;">-->
                            <!--<tbody>-->
                            <!--<td class="align-middle" v-if="answer.correct">-->
                                <!--<i class="fas fa-check-circle fa-1x5 fa-clicked-stay"></i>-->
                            <!--</td>-->
                            <!--<td class="align-middle" v-else>-->
                                <!--<i class="far fa-check-circle fa-1x5 fa-not-clicked-stay"></i>-->
                            <!--</td>-->
                            <!--</tbody>-->
                        <!--</table>-->
                    <!--</div>-->

                    <!--<h5 class="pl-2">{{answer.title}}</h5>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <div class="row">
            <div v-for="answer in answers">
                <div v-if="answer.question_id === question.id" class="col ml-3 mr-3">
                    <div class="row">
                        <div v-if="question.type === 'Multiple-Choice'">
                            <table style="height: 100%;" class="float-left">
                                <tbody>
                                <td class="align-middle" v-if="answer.correct">
                                    <i class="fas fa-check-circle fa-1x5 fa-clicked-stay"></i>
                                </td>
                                <td class="align-middle" v-else>
                                    <i class="far fa-check-circle fa-1x5 fa-not-clicked-stay"></i>
                                </td>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="pl-2 float-right">{{answer.title}}</h5>
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
        methods:{
            ...mapActions('answer', ['fetchanswers']),
        },
        computed: {
            ...mapGetters('answer', ['answers']),
        },
        props: ['question'],
    }
</script>

<style scoped>

</style>