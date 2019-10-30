<template>
    <div>
        <div class="container">
            <PlayHomeScreen v-if="this.game.name !== '' && this.currentPage === ''"></PlayHomeScreen>

            <PlayRoundPreview v-if="this.currentPage === 'PlayRoundPreview'"></PlayRoundPreview>

            <PlayRoundReview v-if="this.currentPage === 'PlayRoundReview'"></PlayRoundReview>

            <PlayRevealAnswer v-if="this.currentPage === 'PlayRevealAnswer'"></PlayRevealAnswer>

            <PlayLeaderBoard  v-if="this.currentPage === 'PlayLeaderBoard'"> </PlayLeaderBoard>
        </div>

        <PlayQuestion v-if="this.currentPage === 'PlayQuestion'"></PlayQuestion>

        <PlayGameOver v-if="this.currentPage === 'PlayGameOver'"></PlayGameOver>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {}
        },
        mounted() {

        },
        methods: {},
        computed: {
            ...mapGetters('play', ['page']),
            ...mapGetters('game', ['game']),
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            }
        },
    }

</script>

<style scoped>

</style>
