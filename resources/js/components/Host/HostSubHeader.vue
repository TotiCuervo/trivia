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
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                nextPage: '',
                leftContent: '',
                iconClass: '',

            }
        },
        mounted() {

        },
        methods: {
            changePage(page) {
                this.currentPage = page;
            },
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

        }

    }
</script>

<style scoped>

</style>
