<template>
    <div>
<!--        &lt;!&ndash;For multiple choice&ndash;&gt;-->
<!--        <div v-if="questionType === 'Multiple-Choice'">-->
<!--            <div class="row">-->
<!--                <div class="col-md-10 offset-md-1">-->
<!--                    <small class="form-text text-muted mt-0" v-if="this.order_number <= 1">-->
<!--                        (Required)-->
<!--                    </small>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row mb-3">-->
<!--                <div class="col-md-1 pr-4">-->
<!--                    <table style="height: 100%;">-->
<!--                        <tbody>-->
<!--                        <td class="align-middle" v-if="this.answerCorrect">-->
<!--                            <span class="size-1x5 color-gray trans-1 then-green clicker" @click="toggleClicked"><i class="fas fa-check-circle"></i></span>-->
<!--                        </td>-->
<!--                        <td class="align-middle" v-else @click="toggleClicked">-->
<!--                            <span class="size-1x5 fa-green"><i class="far fa-check-circle"></i></span>-->
<!--                        </td>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--                <div class="col-md-10">-->
<!--                    <input type="text" class="form-control" placeholder="Enter Answer" v-model="answerTitle">-->
<!--                </div>-->
<!--                <div class="col-md-1 pl-0" v-if="this.order_number > 1">-->
<!--                    <table style="height: 100%;">-->
<!--                        <tbody>-->
<!--                        <td class="align-middle">-->
<!--                            <span class="color-gray then-red trans-1 clicker" @click="toggleDelete"><i class="far fa-trash-alt"></i></span>-->
<!--                        </td>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash;For fill in the blank&ndash;&gt;-->

<!--        <div v-else>-->
<!--            <div class="row mb-3">-->
<!--                <div class="col-md-10 offset-md-1">-->
<!--                    <small class="form-text text-muted mt-0" v-if="this.order_number === 0">-->
<!--                        (Required)-->
<!--                    </small>-->
<!--                    <input type="text" class="form-control" placeholder="Enter Answer" v-model="answerTitle">-->
<!--                </div>-->
<!--                <div class="col-md-1 pl-0" v-if="this.order_number > 0">-->
<!--                    <table style="height: 100%;">-->
<!--                        <tbody>-->
<!--                        <td class="align-middle">-->
<!--                            <span class="color-gray then-red trans-1 clicker" @click="toggleDelete"><i class="far fa-trash-alt"></i></span>-->
<!--                        </td>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        -->
<!--        -->



        <!--For multiple choice-->
        <div v-if="questionType === 'Multiple-Choice'">
            <div class="row mb-3">
                <div class="col-10 offset-1">
                    <div class="input-group">

                        <div class="input-group-prepend clicker" @click="toggleClicked">
                            <button class="btn btn-outline-success" v-bind:class="{'form-button-success': !this.clicked, 'form-button-success-clicked': this.clicked}" type="button" id="button-addon3">
                                <span v-bind:class="{'color-white': this.clicked}"><i class="fas fa-check-circle"></i></span>
                            </button>
                        </div>

                        <input type="text" class="form-control form-control-correct" v-bind:class="{'form-control-delete': this.order_number > 0}" v-if="this.order_number <= 1" placeholder="Enter Answer - Required" v-model="answerTitle">
                        <input type="text" class="form-control form-control-correct" v-bind:class="{'form-control-delete': this.order_number > 0}" v-else placeholder="Enter Answer" v-model="answerTitle">
                        <div class="input-group-append clicker" @click="toggleDelete" v-if="this.order_number > 0">
                            <button class="btn btn-outline-danger form-button-delete" type="button" id="button-addon4">
                                <span><i class="far fa-trash-alt"></i></span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

         <!--For fill in the blank-->

        <div v-else>
            <div class="row mb-3">
                <div class="col-10 offset-1">

                    <input type="text" class="form-control" placeholder="Enter Answer - Required" v-model="answerTitle" v-if="this.order_number === 0">

                    <div class="input-group" v-if="this.order_number > 0">
                        <input type="text" class="form-control form-control-delete" placeholder="Enter Answer" v-model="answerTitle">
                        <div class="input-group-append clicker" @click="toggleDelete">
                            <button class="btn btn-outline-danger form-button-delete" type="button" id="button-addon2">
                                <span><i class="far fa-trash-alt"></i></span>
                            </button>
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
                clicked: false,
            }
        },
        mounted() {
            this.clicked = this.answerForm[this.order_number].correct;

        },
        methods:{
            ...mapActions('answer', ['deletedAnswer']),
            toggleClicked() {
                this.clicked = !(this.clicked);
                this.$store.commit('answer/UPDATE_CORRECT', this.order_number);
            },
            toggleDelete(){

                this.answerTitle = '';
                this.deletedAnswer(this.order_number);
                this.$emit('deleted', this.order_number);

            },
        },
        computed: {
            ...mapGetters('answer', ['answerFields']),
            ...mapGetters('question', ['formType']),

            questionType: {
                get() {
                    return this.formType;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_TYPE', value);
                }
            },
            answerTitle: {
                get() {
                    return this.answerFields[this.order_number].title;
                },

                set(value) {
                    let payload = {title: value, order: this.order_number};
                    this.$store.commit('answer/UPDATE_TITLE', payload);
                }
            },
            answerQuestionID: {
                get() {
                    return this.answerFields[this.order_number].question_id;
                },
                set(value) {
                    let payload = {questionID: value, order: this.order_number};
                    this.$store.commit('answer/UPDATE_QUESTION_ID', value);
                }
            },
            answerCorrect: {
                get() {
                    return this.answerFields[this.order_number].correct;

                },
                set(value) {
                    this.$store.commit('answer/CORRECT', value);
                }
            },
            answerForm: {
                get() {
                    return this.answerFields;
                }
            }

        },
        props: ['order_number'],
    }
</script>
<style scoped>

</style>
