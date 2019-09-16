<template>
    <div class="container" id="reveal-answer">
        <!--Question Title-->
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>{{this.questions[questionPosition].title}}</h3>
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
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {

            }
        },
        mounted() {

        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('team', ['teamAnswers']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page', 'myAnswers']),
        },
        props: ['revealAnswer'],

    }
</script>

<style scoped>

</style>