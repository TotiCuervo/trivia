<template>
    <div>
        <transition name="fade">
            <div v-if="this.answered">
                <span class="mb-0 p"><HostTeamName :team="this.team"></HostTeamName></span>
            </div>
        </transition>
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
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
        },
        props: ['team', 'answered']
    }
</script>

<style scoped>

</style>