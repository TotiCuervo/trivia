<template>
    <div class="row">
        <div class="col-10">
            <div class="row">
                <div class="col-12 col-md-auto col-sm-auto text-center ml-3 mr-3" v-for="answer in answers.filter(x => x.question_id === question.id)">
                    <div class="row">
                        <div v-if="question.type === 'Multiple-Choice'">
                            <span class="fa-1x color-green" v-if="answer.correct"><i class="fas fa-check-circle"></i></span>
                            <span class="fa-1x color-gray" v-else><i class="fas fa-check-circle"></i></span>
                        </div>
                        <p class="m-0 pl-2 float-right">{{answer.title}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <small class="text-really-muted" style="position: absolute; bottom: 0; right: 0; padding-right: 10px;">Answers</small>
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
