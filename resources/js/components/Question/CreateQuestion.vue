<template>
    <div>
        <h1>New Question:</h1>
        <b-form-group>
            <b-form-textarea
                    id="textarea-state"
                    v-model="questionTitle"
                    :state="null"
                    placeholder="Enter Question"
                    rows="4"
                    type="text"
                    required
                    v-if="validation"
            ></b-form-textarea>
            <b-form-textarea
                    id="textarea-state"
                    v-model="questionTitle"
                    :state="validation"
                    placeholder="Enter Question"
                    rows="4"
                    required
                    v-if="!validation"
            ></b-form-textarea>
            <small v-if="validation">{{textLimit - questionTitle.length}}</small>
            <b-form-invalid-feedback :state="validation">
                {{textLimit - questionTitle.length}}
            </b-form-invalid-feedback>

        </b-form-group>

    </div>
</template>


<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                textLimit: 100,
            }
        },
        mounted() {

            //gets the params from the url
            this.routeParams = this.$route.params;

        },
        methods:{
        },
        computed: {
            ...mapGetters('question', ['formTitle', 'formType', 'questions', 'questionFields', 'loading']),

            questionTitle: {
                get() {
                    return this.formTitle;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_TITLE', value);
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
            questionForm: {
                get() {
                    return this.questionFields;
                }
            },
            questionLoading: {
                get() {
                    return this.loading;
                }
            },
            validation() {

                if (this.questionTitle !== null) {
                    return this.questionTitle.length < 100
                }

            }
        }
    }
</script>

<style scoped>

</style>