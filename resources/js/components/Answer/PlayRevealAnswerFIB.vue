<template>
    <div>
        <!--Fill in Blank-->
        <div class="row pt-5 justify-content-center">
            <div class="col-md-6 col-sm-10">
                <h5 v-bind:class="{'text-white': this.darkMode}">Team Answer:</h5>
            </div>
        </div>
        <div class="row pt-2 justify-content-center">
            <div class="col-md-6 col-sm-10">
                <!--if there is an answer-->
                <div class="scene" v-if="this.teamAnswer">
                    <transition name="flip" mode="out-in">
                        <div class="fancy3 card" v-if="!revealAnswer" key="slide1" style="padding: 50px 0px;" v-bind:class="{'darkMode-card text-white': this.darkMode}">
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
                        <div class="fancy3 card" v-if="revealAnswer" key="slide2" style="padding: 50px 0px;" v-bind:class="{'darkMode-card text-white': this.darkMode}">
                            <div class="card-body">
                                <div class="row" style="margin-bottom:-30px;">
                                    <div class="col-md-12 text-center">
                                        <h5 class="m-0">
                                            {{this.teamAnswer.answer}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="correct-answer float-right" v-if="this.teamAnswer.correct">Correct</div>
                                    <div class="wrong-answer float-right" v-if="!this.teamAnswer.correct">Wrong</div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>

                <!--if there is no answer-->
                <div class="fancy3 card" v-else style="padding: 50px 0px;" v-bind:class="{'darkMode-card text-white': this.darkMode}">
                    <div class="card-body">
                        <div class="row" style="margin-bottom:-30px;">
                            <div class="col-md-12 text-center">
                                <h5 class="m-0" v-bind:class="{'text-white': this.darkMode}">
                                    No Answer :/
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wrong-answer float-right">Wrong</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Show Answer-->
        <div class="row pt-5 justify-content-center" v-if="revealAnswer" v-bind:class="{'text-white': this.darkMode}">
            <div class="col-md-6 col-sm-10">
                <h5>Correct Answers:</h5>
            </div>
        </div>
        <div class="row justify-content-center pb-3" v-if="revealAnswer" v-for="answer in this.answers.filter(x => x.correct === 1 && x.question_id === questions[questionPosition].id)">
            <div class="col-md-6 col-sm-10 text-center">
                <div class="answer-card card" v-bind:class="{'darkMode-card text-white': darkMode}">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="m-0">{{answer.title}}</h5>
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
