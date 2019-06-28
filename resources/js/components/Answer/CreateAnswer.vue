<template>
    <div>
        <h1>Answer:</h1>
        <div class="form-group">
            <label>Question</label>
            <input type="text" class="form-control" placeholder="Enter Name" v-model="answerTitle">
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

        },
        computed: {
            ...mapGetters('answer', ['formTitle', 'formQuestionID', 'formCorrect']),

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
            }
        }
    }
</script>


<style scoped>

</style>