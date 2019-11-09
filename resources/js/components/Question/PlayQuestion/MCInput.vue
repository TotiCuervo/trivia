<template>
    <div>
        <div class="row pt-3 justify-content-center">
            <div class="col-md-6 col-lg-4 text-center">
                <div v-for="(answer,index) in this.answers.filter(x => x.question_id === this.questions[this.questionPosition].id)">
                    <div class="row pb-3">
                        <div class="col-md-12 text-center">
                            <div class="answer-card card clicker" @click="selectAnswer(answer)" v-bind:class="cardBind(index, answer)">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <span class="m-0 float-left pl-2" v-bind:class="{'text-white': playerAnswer === answer.title , 'color-red': index === 0, 'color-blue': index === 1, 'color-green': index === 2, 'color-yellow': index === 3}">
                                            <b>{{options[index]}}</b>
                                        </span>
                                            <span class="h5 m-0 pr-2" v-bind:class="{'text-white': darkMode}">{{answer.title}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                options: ['A', 'B', 'C', 'D'],
            }
        },
        mounted() {

        },
        methods: {
            selectAnswer(answer) {
                this.playerAnswer = answer.title;
            },
            cardBind(index, answer) {
                return {
                    'isChosen': this.playerAnswer === answer.title && !this.darkMode,
                    'darkMode-bc': this.playerAnswer !== answer.title && this.darkMode,
                    'darkMode-answer-card color-black': this.playerAnswer === answer.title && this.darkMode,
                    'border-1': this.darkMode,
                    'color-red': index === 0 && this.darkMode && this.playerAnswer !== answer.title,
                    'color-blue': index === 1 && this.darkMode && this.playerAnswer !== answer.title,
                    'color-green': index === 2 && this.darkMode && this.playerAnswer !== answer.title,
                    'color-yellow': index === 3 && this.darkMode && this.playerAnswer !== answer.title,
                }
            }
        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers', 'answer']),
            ...mapGetters('play', ['questionPosition']),
            ...mapGetters('user', ['darkMode']),

            playerAnswer: {
                get() {
                    return this.answer;
                },
                set(value) {
                    this.$store.commit('answer/SET_ANSWER', value);
                }
            }
        },
    }
</script>

<style scoped>

</style>
