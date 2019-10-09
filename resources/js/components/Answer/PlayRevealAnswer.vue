<template>
    <div>
        <transition name="fade">
            <div class="row pt-4 text-center" v-if="this.show_loading">
                <div class="col-md-12">
                    <h2 style="font-size:5rem">Round</h2>
                </div>
                <div class="col-md-12">
                    <h2 style="font-size:5rem">{{this.rounds[this.roundPosition].order_number}}</h2>
                </div>
                <div class="col-md-12 pt-3">
                    <h2 style="font-size:3rem">Question {{this.questions[questionPosition].order_number}}</h2>
                </div>
                <div class="col-md-12 pt-4">
                    <h3>Answer, coming right up...</h3>
                </div>

            </div>
        </transition>

        <transition name="fade">
            <div class="container" id="reveal-answer" v-if="show_answer">
                <!--Question Title-->
                <div class="row pt-5">
                    <div class="col-md-8 offset-md-2 text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 v-bind:class="{'color-white': darkMode}">{{this.questions[questionPosition].title}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Fill in Blank-->
                <div v-if="this.questions[questionPosition].type === 'Fill-in-blank'">
                    <PlayRevealAnswerFIB :revealAnswer="this.revealAnswer"></PlayRevealAnswerFIB>
                </div>
                <!--Multiple Choice-->
                <div v-else>
                    <PlayRevealAnswerMC :revealAnswer="this.revealAnswer"></PlayRevealAnswerMC>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                show_loading: true,
                show_answer: false,
            }
        },
        mounted() {
            this.show_loading = false;

            let vm = this;
            setTimeout(function(){
                vm.show_answer = true;
            }, 2000);

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
                this.show_loading = true;
                this.show_answer = false;
            },
        }


    }
</script>

<style scoped>

</style>
