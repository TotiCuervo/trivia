<template>
    <div>
        <!--Type Selections-->
        <div class="row pb-3">

            <!--Type-->
            <div class="col-6 offset-1">
                <select class="custom-select mt-2" v-model="questionType" @change="changeOrderNumber">
                    <option value='' disabled>Choose Question Type</option>
                    <option value='Fill-in-blank' selected>Fill In The Blank</option>
                    <option value="Multiple-Choice">Multiple Choice</option>
                </select>
            </div>

            <!--Add Answers-->
            <div class="col-4">
                <div v-if="this.order_number === 4">
                    <button type="button" class="btn btn-success w-100 mt-2 p" disabled>Max 4</button>
                </div>
                <div v-else>
                    <button type="button" class="btn btn-outline-success w-100 mt-2" @click="addAnswerOrder">Add Answer</button>
                </div>
            </div>
        </div>
        <!--AnswerFields-->
        <div class="col-10 offset-1" v-if="this.formType === 'Multiple-Choice'">
            <small class="form-text text-center text-muted mt-0 pb-2">At least one answer must be correct</small>
        </div>
        <div v-for="(n, index) in this.order_number">
            <AnswerField :order_number="index" @deleted="deletedWasClicked"></AnswerField>
        </div>
    </div>
</template>


<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                order_number: 1,
                type: 0
            }
        },
        mounted() {
            this.checkOrderNumber();
            this.type= 1;
        },
        methods:{
            checkOrderNumber() {
                for (let $i = 1; $i <= 3; $i++ ){

                    if (!(this.answerForm[$i].title === ''))
                    {
                        this.order_number++;
                    }
                }
            },
            addAnswerOrder() {
                this.order_number++;
            },
            changeOrderNumber() {

                //if someone clicks on multiple choice and they don't already have two answer forms
                if (this.order_number < 2 && this.formType === 'Multiple-Choice')
                {
                    this.order_number = 2;
                }
                //if someone goes to multiple choice and then back to fill in the blank
                else if (this.order_number === 2 && this.answerFields[1].title === '')
                {
                    this.order_number = 1;
                }
            },
            deletedWasClicked() {
                this.order_number--;
            },
        },
        computed: {
            ...mapGetters('question', ['formType']),
            ...mapGetters('answer', ['answerFields']),

            questionType: {
                get() {
                    return this.formType;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_TYPE', value);
                }
            },
            //Answers
            answerForm: {
                get() {
                    return this.answerFields;
                },
            },
        },
        watch: {
            type: function () {

                if (this.questionType === '') {
                    this.questionType = 'Fill-in-blank'
                }
            },
        }
    }
</script>


<style scoped>

</style>
