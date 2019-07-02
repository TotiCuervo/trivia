<template>
    <div>
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <select class="form-control mt-2" v-model="questionType">
                    <option value='Fill-in-blank' selected>Fill In The Blank</option>
                    <option value="Multiple-Choice">Multiple Choice</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-outline-success w-100 mt-2" @click="addAnswerOrder">Add Answer</button>
            </div>
        </div>

        <div class="pt-3">
            <div v-if="questionType === 'Multiple-Choice' ">
                <div class="row pt-3">
                    <div class="col-md-12">
                        <h1>Poop</h1>
                    </div>
                </div>
            </div>
            <div v-else>
                <div v-for="(n, index) in this.order_number">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Answer" v-model="answerTitle">
                                <small class="form-text text-muted">
                                    (Required)
                                </small>
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

            }
        },
        methods:{
            addAnswerOrder()
            {
                this.order_number++;
            },
        },
        computed: {
            ...mapGetters('answer', ['formTitle', 'formQuestionID', 'formCorrect']),
            ...mapGetters('question', ['formType']),


            answerTitle: {
                get() {
                    return this.formTitle;
                },
                set(value) {
                    this.$store.commit('answer/UPDATE_TITLE', value);
                }
            },
            answerQuestionID: {
                get() {
                    return this.formQuestionID;
                },
                set(value) {
                    this.$store.commit('answer/UPDATE_QUESTION_ID', value);
                }
            },
            answerCorrect: {
                get() {
                    return this.formCorrect;
                },
                set(value) {
                    this.$store.commit('answer/CORRECT', value);
                }
            },
            questionType: {
                get() {
                    return this.formType;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_TYPE', value);
                }
            },
        }
    }
</script>


<style scoped>

</style>