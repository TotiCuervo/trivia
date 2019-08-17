<template>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>{{this.questions[questionPosition].title}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="this.questions[questionPosition].type === 'Fill-in-blank'">
            <div class="row pt-5 fill-in-blank">
                <div class="col-md-4 offset-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Team Answer:</h4>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12 text-center">
                            <h5>{{this.myAnswers}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-4 offset-md-4 text-center">
                    <div v-for="answer in this.answers">
                        <div class="row pt-3" v-if="answer.correct === 1 && answer.question_id === questions[questionPosition].id">
                            <div class="col-md-12">
                                <h5>{{answer.title}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-5 fill-in-blank" v-else>
            <div class="col-md-4 offset-md-4 text-center">
                <div v-for="answer in this.answers">
                    <div class="row pb-3" v-if="answer.question_id === questions[questionPosition].id">
                        <div class="col-md-12 text-center">
                            <div class="fancy2 card">
                                <div class="card-body p-2">
                                    <h5 class="mb-0">{{answer.title}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-12">
                        <b-button variant="success" block>Submit Answer</b-button>
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

            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page', 'myAnswers']),
        }
    }
</script>

<style scoped>

</style>