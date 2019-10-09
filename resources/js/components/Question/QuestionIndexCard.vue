<template>
    <div v-if="this.id">

        <div class="card" @click="clickQuestion()"
             v-bind:class="{ 'blank-card': (this.currentRound.id !== this.round_id), 'darkMode': this.darkMode ,'darkMode-card-2': this.darkMode && (this.currentRound.id === this.round_id)}">
            <div class="card-body p-2">
                <div class="row">
                    <!--if current round-->
                    <div class="col-10 col-sm-9 col-md-10 pr-0" v-if="this.currentRound.id === this.round_id">
                        <div v-if="question.type === 'Fill-in-blank' ">
                            <span class="small text-muted">Question {{question.order_number}}: Fill In The Blank</span>
                        </div>
                        <div v-else>
                            <span class="small text-muted">Question {{question.order_number}}: Multiple Choice</span>
                        </div>
                        <p class="m-0"><b>{{question.title}}</b></p>
                    </div>
                    <!--if not current round-->
                    <div class="col-10 col-sm-9 col-md-11 pr-0" v-else>
                        <div v-if="question.type === 'Fill-in-blank' ">
                            <span class="small text-muted">Question {{question.order_number}}: Fill In The Blank</span>
                        </div>
                        <div v-else>
                            <span class="small text-muted">Question {{question.order_number}}: Multiple Choice</span>
                        </div>
                        <p class="m-0"><b>{{question.title}}</b></p>
                    </div>

                    <div class="col-2 col-sm-3 col-md-2 pl-0">
                        <div class="float-right" v-show="this.currentRound.id === this.round_id">
                            <div class="dropdown dropleft">
                                <span class="fa-1x first-gray trans-1 clicker" v-bind:class="{'then-black': !this.darkMode, 'then-white': this.darkMode}" v-b-tooltip.top  title="Edit question" @click="loadEditData()" v-b-modal.edit-question>
                                    <i class="fas fa-pen"></i>
                                </span>
                                <span class="fa-1x mt-2 first-gray trans-1 clicker" v-bind:class="{'then-black': !this.darkMode, 'then-white': this.darkMode}" v-b-tooltip.top title="Delete question" v-b-modal.delete-question>
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul v-show="this.currentRound.id === this.round_id" class="list-group list-group-flush">
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
            clickQuestion() {
                this.current_Question = this.question;
            },
            toggleClicked() {
                this.clicked = !(this.clicked);
            },
            delete_Question() {

                this.deleteQuestion();

            },
            loadEditData() {
                this.$store.commit('question/SET_QUESTION_FORM', {
                    id: this.question.id,
                    title: this.question.title,
                    type: this.question.type,
                    round_id: this.question.round_id,
                    order_number: this.question.order_number,
                });
                this.$store.commit('answer/SET_ANSWERS_FORM', this.answers.filter(x => x.question_id === this.question.id));
            }
        },
        computed: {
            ...mapGetters('round', ['currentRound']),
            ...mapGetters('question', ['currentQuestion']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('user', ['darkMode']),

            current_Question: {
                get() {
                    return this.currentQuestion;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_QUESTION', value);
                }
            }

        },
        props: ['question', 'round_id'],
    }
</script>

<style scoped>

</style>
