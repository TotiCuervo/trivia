<template>
    <div v-if="this.id">

        <div class="card" @click="clickQuestion()"
             v-bind:class="{ 'blank-card': (this.currentRound.id !== this.round_id) }">
            <div class="card-body p-2">
                <div class="row">
                    <!--Question index-->
<!--                    <div class="col-2 col-sm-1 col-md-1 pr-0">-->
<!--                        <p class="m-0">Q{{question.order_number}}:</p>-->
<!--                        <span v-show="this.round_id === this.currentRound.id"><i class="fas fa-arrows-alt"></i></span>-->
<!--                    </div>-->
                    <!--if current round-->
                    <div class="col-8 col-sm-9 col-md-9 pr-0" v-if="this.currentRound.id === this.round_id">
                        <div v-if="question.type === 'Fill-in-blank' ">
                            <span class="small text-muted">Fill In The Blank</span>
                        </div>
                        <div v-else>
                            <span class="small text-muted">Multiple Choice</span>
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

                    <div class="col-2 col-md-2 pl-0">
                        <div class="float-right" v-show="this.currentRound.id === this.round_id">
                            <div class="dropdown dropleft">
                                <span class="fa-1x first-gray then-black trans-1 clicker" v-b-tooltip.top
                                      title="Edit question" @click="loadEditData()" v-b-modal.edit-question>
                                    <i class="fas fa-pen"></i>
                                </span>
                                <span class="fa-1x mt-2 first-gray then-black trans-1 clicker" v-b-tooltip.top
                                      title="Delete question" v-b-modal.delete-question>
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

<!--    <div v-if="this.id">-->
<!--        <div class="card" @click="clickQuestion()" v-bind:class="{ 'blank-card': (this.currentRound.id !== this.round_id) }">-->
<!--            <div class="card-body p-2">-->
<!--                <div class="row">-->

<!--                    &lt;!&ndash;if current round&ndash;&gt;-->
<!--                    <div class="col-8 col-sm-9 col-md-10 pr-0" v-if="this.currentRound.id === this.round_id">-->
<!--                        <div v-if="question.type === 'Fill-in-blank' ">-->
<!--                            <span class="small text-muted">Question {{question.order_number}}: Fill In The Blank</span>-->
<!--                        </div>-->
<!--                        <div v-else>-->
<!--                            <span class="small text-muted">Question {{question.order_number}}: Multiple Choice</span>-->
<!--                        </div>-->
<!--                        <p class="m-0"><b>{{question.title}}</b></p>-->
<!--                    </div>-->
<!--                    &lt;!&ndash;if not current round&ndash;&gt;-->
<!--                    <div class="col-10 col-sm-9 col-md-12 pr-0" v-else>-->
<!--                        <div v-if="question.type === 'Fill-in-blank'">-->
<!--                            <span class="small text-muted">Question {{question.order_number}}: Fill In The Blank</span>-->
<!--                        </div>-->
<!--                        <div v-else>-->
<!--                            <span class="small text-muted">Question {{question.order_number}}: Multiple Choice</span>-->
<!--                        </div>-->
<!--                        <p class="m-0"><b>{{question.title}}</b></p>-->
<!--                    </div>-->

<!--                    <div class="col-2 col-md-2 pl-0">-->
<!--                        <div class="float-right" v-show="this.currentRound.id === this.round_id">-->
<!--                            <div class="dropdown dropleft">-->
<!--                                <span class="fa-1x first-gray then-black trans-1 clicker" v-b-tooltip.top-->
<!--                                      title="Edit question" @click="loadEditData()" v-b-modal.edit-question>-->
<!--                                    <i class="fas fa-pen"></i>-->
<!--                                </span>-->
<!--                                <span class="fa-1x mt-2 first-gray then-black trans-1 clicker" v-b-tooltip.top-->
<!--                                      title="Delete question" v-b-modal.delete-question>-->
<!--                                    <i class="fas fa-trash-alt"></i>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <ul v-show="this.currentRound.id === this.round_id" class="list-group list-group-flush">-->
<!--                <li class="list-group-item">-->
<!--                    <AnswerIndex :question="question"></AnswerIndex>-->
<!--                </li>-->
<!--            </ul>-->

<!--        </div>-->
<!--    </div>-->
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

                // axios.delete('/api/question/' + this.question.id +'/destroy')
                //     .then(response => {
                //         console.log(this.question.order_number);
                //         this.$store.commit('question/DELETE_FROM_QUESTIONS', this.question.order_number);
                //         // this.$router.push({name: "gameDetails", params: {id: this.id.id}});
                //     })
                //     .catch(error => {
                //         console.log(error);
                //     });


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
