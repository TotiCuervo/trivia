<template>
    <div v-if="this.id">

        <div class="card" @click="clickQuestion()" v-bind:class="{ 'blank-card': (this.currentRound.id !== this.round_id), 'question-card': (this.currentRound.id === this.round_id && this.current_Question.id !== this.question.id) }">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-1">
                        <p class="m-0">Q{{question.order_number}}:</p>
                        <i class="fas fa-arrows-alt" v-show="this.round_id === this.currentRound.id"></i>

                    </div>
                    <div class="col-md-10 clicker">
                        <div v-if="question.type === 'Fill-in-blank' ">
                            <span class="text-muted">(Fill In The Blank)</span>
                        </div>
                        <div v-else>
                            <span class="text-muted">(Multiple Choice)</span>
                        </div>
                        <p class="m-0"><b>{{question.title}}</b></p>
                    </div>
                    <div class="col-md-1">
                        <div class="float-right" v-show="this.current_Question.id === this.question.id">
                            <div class="dropdown dropleft">
                                <router-link :to="{ name: 'editQAForm', params: { id: id.id, round_id: round_id, question_id: question.id } }" class="clicker">
                                    <i class="fas fa-pen fa-white fa-1x circle-icon-edit" v-b-tooltip.left title="Edit question"></i>
                                </router-link>

                                <i class="fas fa-trash-alt fa-white fa-1x circle-icon-delete mt-2" v-b-tooltip.left title="Delete question" v-b-modal.delete-question ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul v-show="this.current_Question.id === this.question.id" class="list-group list-group-flush">
                <li class="list-group-item">
                    <AnswerIndex :question="question"></AnswerIndex>
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                id: '',
                clicked: false,
            }
        },
        mounted() {
            this.id = this.$route.params;
        },
        methods: {
            ...mapActions('question', ['deleteQuestion']),
            clickQuestion(){
                this.current_Question = this.question;
            },
            toggleClicked(){
                this.clicked = !(this.clicked);
            },
            delete_Question() {

                this.deleteQuestion();

                // axios.delete('/api/question/' + this.question.id +'/destroy')
                //     .then(response => {
                //         console.log(this.question.order_number);
                //         this.$store.commit('question/DELETE_FROM_QUESTIONS', this.question.order_number);
                //         // this.$router.push({name: "gameDetails", params: {id: this.id.id}});
                //     })
                //     .catch(error => {
                //         console.log(error);
                //     });


            }
        },
        computed: {
            ...mapGetters('round', ['currentRound']),
            ...mapGetters('question', ['currentQuestion']),
            current_Question: {
                get() {
                    return this.currentQuestion;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_QUESTION', value);
                }
            }

        },
        props: ['question','round_id'],
    }
</script>

<style scoped>

</style>