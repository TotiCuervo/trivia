<template>
    <div>

        <div v-if="questionType === 'Multiple-Choice'">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <small class="form-text text-muted mt-0" v-if="this.order_number <= 1">
                        (Required)
                    </small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-1 pr-4">
                    <table style="height: 100%;">
                        <tbody>
                            <td class="align-middle" v-if="this.answerCorrect">
                                <i class="fas fa-check-circle fa-1x5 fa-clicked" @click="toggleClicked"></i>
                            </td>
                            <td class="align-middle" v-else @click="toggleClicked">
                                <i class="far fa-check-circle fa-1x5 fa-not-clicked"></i>
                            </td>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Enter Answer" v-model="answerTitle">
                </div>
                <div class="col-md-1 pl-0" v-if="this.order_number > 1">
                    <table style="height: 100%;">
                        <tbody>
                        <td class="align-middle">
                            <i class="far fa-trash-alt fa-not-clicked-delete" @click="toggleDelete"></i>
                        </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="row mb-3">
                <div class="col-md-10 offset-md-1">
                    <small class="form-text text-muted mt-0" v-if="this.order_number === 0">
                        (Required)
                    </small>
                    <input type="text" class="form-control" placeholder="Enter Answer" v-model="answerTitle">
                </div>
                <div class="col-md-1 pl-0" v-if="this.order_number > 0">
                    <table style="height: 100%;">
                        <tbody>
                        <td class="align-middle">
                            <i class="far fa-trash-alt fa-not-clicked-delete" @click="toggleDelete"></i>
                        </td>
                        </tbody>
                    </table>
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
        props: ['order_number'],
        computed: {
            ...mapGetters('answer', ['answerFields', 'formTitle']),
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

        }
    }
</script>
<style scoped>

</style>