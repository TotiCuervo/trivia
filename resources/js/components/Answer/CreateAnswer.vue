<template>
    <div>
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <select class="form-control mt-2" v-model="questionType" @change="changeOrderNumber">
                    <option value='Fill-in-blank' selected>Fill In The Blank</option>
                    <option value="Multiple-Choice">Multiple Choice</option>
                </select>
            </div>
            <div class="col-md-4">
                <div v-if="this.order_number === 7">
                    <button type="button" class="btn btn-danger w-100 mt-2">Cut off: 7 Answers</button>
                </div>
                <div v-else>
                    <button type="button" class="btn btn-outline-success w-100 mt-2" @click="addAnswerOrder">Add Answer</button>
                </div>
            </div>
        </div>

        <div class="pt-3">

            <div v-for="(n, index) in this.order_number">
                <div class="row">
                    <div class="col-md-12">
                        <AnswerField :order_number="index" @deleted="deletedWasClicked"></AnswerField>
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
                order_number: 1,
            }
        },
        methods:{
            addAnswerOrder()
            {
                this.order_number++;
            },
            changeOrderNumber() {
                //if someone clicks on multiple choice and they don't already have two answer forms
                if (this.order_number < 2 && this.formType === 'Multiple-Choice')
                {
                    //make this order_number = 2
                    this.order_number = 2;
                }
                else if (this.order_number == 2 && this.answerFields[1].title === "")
                {
                    this.order_number = 1;
                }
            },
            deletedWasClicked(order) {
                this.order_number--;
            },
        },
        computed: {
            ...mapGetters('question', ['formType']),
            ...mapGetters('answer', ['answerFields', 'formTitle']),

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