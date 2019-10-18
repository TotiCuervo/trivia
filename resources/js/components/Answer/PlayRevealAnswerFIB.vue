<template>
    <div>
        <!--Fill in Blank-->
        <div class="row pt-5 fill-in-blank">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5 v-bind:class="{'text-white': this.darkMode}">Team Answer:</h5>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-10 offset-1">
                        <!--if there is an answer-->
<!--                        <div class="fancy3 card" v-if="this.teamAnswer" style="padding: 50px 0px;" v-bind:class="{'darkMode-card text-white': this.darkMode,'bg-success text-white': this.teamAnswer.correct && revealAnswer,'bg-danger text-white': !this.teamAnswer.correct && revealAnswer}">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-12 text-center">-->
<!--                                        <h5 class="m-0">-->
<!--                                            {{this.teamAnswer.answer}}-->
<!--                                        </h5>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="scene">
                            <transition name="flip">
                                <div class="fancy3 card flipped-card" v-if="this.teamAnswer && !this.clicked" style="padding: 50px 0px;" v-bind:class="{'darkMode-card text-white': this.darkMode}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h5 class="m-0">
                                                    {{this.teamAnswer.answer}}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                            <transition name="flip">
                                <div class="fancy3 card flipped-card" v-if="this.teamAnswer && this.clicked" style="padding: 50px 0px;" v-bind:class="{'darkMode-card text-white': this.darkMode}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h5 class="m-0">
                                                    {{this.teamAnswer.answer}} ANSWER
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                        </div>

                        <button type="button" class="btn btn-black" @click="toggleClicked()">click</button>


                        <!--if there is no answer-->
<!--                        <div class="fancy3 card" v-else style="padding: 50px 0px;" v-bind:class="{'darkMode-card text-white': this.darkMode, 'bg-danger text-white': revealAnswer}">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-12 text-center">-->
<!--                                        <h5 class="m-0" v-bind:class="{'text-white': this.darkMode}">-->
<!--                                            No Answer :/-->
<!--                                        </h5>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-5" v-if="revealAnswer" v-bind:class="{'text-white': this.darkMode}">
            <div class="col-md-12 text-center">
                <h5>Correct Answers:</h5>
            </div>
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
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                teamAnswer: '',
                clicked: false
            }
        },
        mounted() {
            this.sortVariable();
        },
        methods: {
            sortVariable() {
                this.teamAnswer = this.teamAnswers.find(x => x.question_id === this.questions[this.questionPosition].id);
            },
            toggleClicked() {
                this.clicked = !this.clicked;
            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('team', ['teamAnswers']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page', 'myAnswers']),
            ...mapGetters('user', ['darkMode']),

        },
        props: ['revealAnswer'],
        watch: {
            questionPosition: function () {
                document.getElementById('reveal-answer').style.color = 'black';
                this.sortVariable();
            },

        }
    }
</script>

<style scoped>

</style>
