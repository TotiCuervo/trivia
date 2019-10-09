<template>
    <div>
        <div class="row pb-2 pt-2" v-for="(answer,index) in this.answers.filter(x => x.question_id === this.questions[this.playQuestionPosition].id)">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-4 offset-md-4 text-center">

                <div class="answer-card card" v-bind:class="{'bg-success text-white': answer.correct === 1 && revealAnswer === true}">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="m-0 float-left pl-2" v-bind:class="{'text-white': answer.correct === 1 && revealAnswer === true, 'color-red': index === 0, 'color-blue': index === 1, 'color-green': index === 2, 'color-yellow': index === 3}">
                                    <b>{{options[index]}}</b>
                                </span>
                                <span class="h5 m-0 pr-2">{{answer.title}}</span>
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
                options: ['A', 'B', 'C', 'D']
            }
        },

        methods: {

        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            playRoundPosition: {
                get() {
                    return this.roundPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_ROUND_POSITION', value);
                }
            },
            playQuestionPosition: {
                get() {
                    return this.questionPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_QUESTION_POSITION', value);
                }
            },
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            }
        },
        props: ['revealAnswer']
    }
</script>

<style scoped>

</style>