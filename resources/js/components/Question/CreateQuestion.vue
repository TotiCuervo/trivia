<template>
    <div>
        <h1></h1>
        <h1>New Question:</h1>
        <div class="form-group">

            <textarea class="form-control" rows="3" v-model="questionTitle" placeholder="Type your question here..."></textarea>

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
            }
        }
    }
</script>

<style scoped>

</style>