<template>
    <div>
        <div class="row pb-4">
            <div class="col-6">
                <h3>Teams: {{this.teams.length}} Teams</h3>
            </div>
            <div class="col-6">
                <div class="float-right">
                    <!--For Production-->
                    <button type="button" class="btn btn-success btn-lg mr-2" v-if="this.teams.length === 0" disabled>
                        Waiting on Players
                    </button>
                    <button type="button" class="btn btn-success btn-lg mr-2" @click='goToStartGame()' v-else>Start
                        Game
                    </button>


                    <!--For workaround in development-->
                    <!--<button type="button" class="btn btn-success btn-lg mr-2" @click='goToStartGame()' v-if="currentPage === 'HostLobby'">Start Game</button>-->
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