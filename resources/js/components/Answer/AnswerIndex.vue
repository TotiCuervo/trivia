<template>
    <div>
        <div class="row">
            <div v-for="answer in answers">
                <div v-if="answer.question_id === question.id" class="col ml-3 mr-3">
                    <div class="row">
                        <div v-if="question.type === 'Multiple-Choice'">
                            <!--<table style="height: 100%;" class="float-left">-->
                                <!--<tbody>-->
                                <!--<td class="align-middle" v-if="answer.correct">-->
                                    <!--<i class="fas fa-check-circle fa-1 fa-clicked-stay"></i>-->
                                <!--</td>-->
                                <!--<td class="align-middle" v-else>-->
                                    <!--<i class="far fa-check-circle fa-1 fa-not-clicked-stay"></i>-->
                                <!--</td>-->
                                <!--</tbody>-->
                            <!--</table>-->
                            <i class="fas fa-check-circle fa-1 fa-clicked-stay" v-if="answer.correct"></i>
                            <i class="far fa-check-circle fa-1 fa-not-clicked-stay" v-else></i>

                        </div>

                        <p class="pl-2 float-right">{{answer.title}}</p>
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