<template>
    <div>
        <h1>Question:</h1>
        <div class="form-group">
            <label>Question</label>
            <input type="text" class="form-control" placeholder="Enter Name" v-model="questionTitle">
        </div>
        <div class="form-group">
            <label>Type</label>
            <select class="form-control" v-model="questionType">
                <option value='Fill-in-blank' selected="selected">Fill In The Blank</option>
                <option value="Multiple-Choice">Multiple Choice</option>
            </select>
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
            ...mapGetters('question', ['formTitle', 'formType', 'formRound_ID']),

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
            questionRound_id: {
                get() {
                    return this.formRoundID;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_ROUND_ID', value);
                }
            }
        }
    }
</script>

<style scoped>

</style>