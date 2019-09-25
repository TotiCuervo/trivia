<template>
    <div>

        <!--For multiple choice-->
        <div v-if="questionType === 'Multiple-Choice'">
            <div class="row mb-3">
                <div class="col-10 offset-1">
                    <div class="input-group">

                        <div class="input-group-prepend clicker" @click="toggleClicked">
                            <button class="btn btn-outline-success" v-bind:class="{'form-button-success': !this.clicked, 'form-button-success-clicked': this.clicked, 'is-invalid': answerTitle.length > this.answerCC}" type="button" id="button-addon3">
                                <span v-bind:class="{'color-white': this.clicked}"><i class="fas fa-check-circle"></i></span>
                            </button>
                        </div>

                        <input type="text" class="form-control form-control-correct" v-bind:class="{'form-control-delete': this.order_number > 1, 'is-invalid': answerTitle.length > this.answerCC}" v-if="this.order_number <= 1" placeholder="Enter Answer - Required" v-model.trim="answerTitle">
                        <input type="text" class="form-control form-control-correct" v-bind:class="{'form-control-delete': this.order_number > 1, 'is-invalid': answerTitle.length > this.answerCC}" v-else placeholder="Enter Answer" v-model.trim="answerTitle">

                        <div class="input-group-append clicker" @click="toggleDelete" v-if="this.order_number > 1">
                            <button class="btn btn-outline-danger form-button-delete" v-bind:class="{'is-invalid': answerTitle.length > this.answerCC}" type="button" id="button-addon4">
                                <span><i class="far fa-trash-alt"></i></span>
                            </button>
                        </div>
                    </div>
                    <b-form-invalid-feedback :state="!(answerTitle.length > this.answerCC)" >
                        {{answerCC - answerTitle.length}}
                    </b-form-invalid-feedback>
                </div>
            </div>
        </div>

         <!--For fill in the blank-->
        <div v-else>
            <div class="row mb-3">
                <div class="col-10 offset-1">

                    <input type="text" class="form-control" v-bind:class="{'is-invalid': answerTitle.length > this.answerCC}" placeholder="Enter Answer - Required" v-model.trim="answerTitle" v-if="this.order_number === 0">

                    <div class="input-group" v-if="this.order_number > 0">

                        <input type="text" class="form-control form-control-delete" v-bind:class="{'is-invalid': answerTitle.length > this.answerCC}" placeholder="Enter Answer" v-model.trim="answerTitle">

                        <div class="input-group-append clicker" @click="toggleDelete">
                            <button class="btn btn-outline-danger form-button-delete" v-bind:class="{'is-invalid': answerTitle.length > this.answerCC}" type="button" id="button-addon2">
                                <span><i class="far fa-trash-alt"></i></span>
                            </button>
                        </div>

                    </div>
                    <b-form-invalid-feedback :state="!(answerTitle.length > this.answerCC)" >
                        {{answerCC - answerTitle.length}}
                    </b-form-invalid-feedback>
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
                answerCC: 30,
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
