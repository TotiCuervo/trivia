<template>
    <div>
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
        methods:{

        },
        computed: {
            ...mapGetters('question', ['formTitle', 'formType']),

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
        }
    }
</script>

<style scoped>

</style>