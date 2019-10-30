<template>
    <div>
        <!--Sub Header-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">

                    <!--left-->
                    <h6 class="m-0 float-left flex-grow-1"><i class="fas fa-user-friends"></i>: {{this.teams.length}} Teams</h6>

                    <h6 class="m-0 flex-grow-1 d-none d-sm-flex">Join this game the code: <u><b>{{this.gameCode.code}}</b></u></h6>

                    <!--right-->
                    <div class="float-right">
                        <b-button pill variant="primary" v-if="this.teams.length === 0" disabled>Waiting for players</b-button>
                        <b-button pill variant="primary" @click='goToStartGame()' v-else>Start Game</b-button>
                    </div>
                </div>
            </div>
        </div>
        <!--Content-->
        <div class="row pt-4">
            <div class="col-md-12">
                <GameTeamIndex :col="3"></GameTeamIndex>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-12 text-center">
                <b-button pill variant="primary" @click="triggerWhisper()">Trigger Whisper</b-button>
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
            triggerWhisper() {

                console.log('made it to triggerWhisper');
                Echo.join('game.'+this.gameCode.code).whisper("trigger", {
                    roundPosition: 1,
                    questionPosition: 0,
                    page: 'PlayRoundPreview'
                });

            }
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
