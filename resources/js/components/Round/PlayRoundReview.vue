<template>
    <div>
        <div class="row pt-5">
            <div class="col-md-12 text-center">
                <h1>Round {{this.rounds[this.roundPosition].order_number}} is done!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Stay tuned for the Answers!</h3>
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
        mounted() {

        },
        methods: {

        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
        },
    }
</script>

<style scoped>

</style>