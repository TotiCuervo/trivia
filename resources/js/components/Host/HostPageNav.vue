<template>
    <div class="pr-3 pl-3">
        <HostLobby v-if="currentPage === 'HostLobby'"></HostLobby>

        <HostStartGame v-if="currentPage === 'HostStartGame'"></HostStartGame>

        <HostRoundPreview v-if="currentPage === 'HostRoundPreview'"></HostRoundPreview>

        <HostQuestionPreview v-if="currentPage === 'HostQuestionPreview'"></HostQuestionPreview>

        <HostQuestion v-if="currentPage === 'HostQuestion'"></HostQuestion>

        <HostRoundReview v-if="currentPage === 'HostRoundReview'"></HostRoundReview>

        <HostAnswerReveal v-if="currentPage === 'HostAnswerReveal'"></HostAnswerReveal>

        <HostLeaderBoard v-if="currentPage === 'HostLeaderBoard'"></HostLeaderBoard>

        <HostGameOver v-if="currentPage === 'HostGameOver'"></HostGameOver>
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
            ...mapGetters('play', ['page']),
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            }
        }
    }
</script>

<style scoped>

</style>
