<template>
    <div>
        <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <CreateQuestion></CreateQuestion>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <CreateAnswer></CreateAnswer>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-success" @click="addQuestion"> Create Question </button>
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
                routeParams: null,
            }
        },
        mounted() {
            this.routeParams = this.$route.params;
            this.questionRoundID = this.routeParams.round_id;
        },
        methods:{
            ...mapActions('question', ['newQuestion']),
            addQuestion()
            {
                this.newQuestion();
                this.$router.push({ name: "showGame", params: { id: this.routeParams.id }});
            },
        },
        computed: {
            ...mapGetters('question', ['formTitle', 'formType', 'formRoundID']),

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
            questionRoundID: {
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