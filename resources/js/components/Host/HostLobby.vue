<template>
    <div>
        <div class="row pb-4">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h5 class="m-0 float-left" style="flex-grow:1">Teams: {{this.teams.length}} Teams</h5>
                    <div class="float-right">
                        <b-button pill variant="primary" v-if="this.teams.length === 0" disabled>Waiting for players</b-button>
                        <b-button pill variant="primary" @click='goToStartGame()' v-else>Start Game</b-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <GameTeamIndex :col="3"></GameTeamIndex>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                params: '',
            }
        },
        mounted() {

        },
        methods: {
            goToStartGame() {
                this.currentPage = 'HostStartGame';
            },
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('team', ['teams']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            },
            game_code: {
                get() {
                    return this.gameCode;
                },
                set(value) {
                    return this.$store.commit('game/SET_GAME_CODE', value);
                }
            }

        }

    }
</script>

<style scoped>

</style>
