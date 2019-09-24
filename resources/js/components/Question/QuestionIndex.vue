<template>
    <div>

        <div class="container">
            <!--if there are questions in the array-->
            <draggable v-model="roundQuestions">
                <div v-for="(question, index) in roundQuestions.filter(x => x.round_id === round_id)" :key="question.id">
                    <div class="row" v-bind:class="{'pb-4': index < roundQuestions.filter(x => x.round_id === round_id).length-1, 'pb-3': index >= roundQuestions.filter(x => x.round_id === round_id).length-1}">
                        <div class="col-md-12 pr-2">
                            <QuestionIndexCard :question="question" :round_id="round_id"></QuestionIndexCard>
                        </div>
                    </div>
                </div>
            </draggable>
        </div>
    </div>

</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import draggable from 'vuedraggable';

    export default {
        data() {
            return {
                id: null,
                clicked: false,
            }
        },
        components: {
            draggable,
        },
        mounted() {
            // this.id = this.$route.params;
            // this.fetchQuestions(this.id.id);
        },
        methods: {
            ...mapActions('question', ['fetchQuestions']),
        },
        computed: {
            ...mapGetters('question', ['questions']),
            roundQuestions: {
                get() {
                    return this.questions;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_LIST', value);
                }
            }
        },
        props: ['round_id'],
    }
</script>

<style scoped>

</style>
