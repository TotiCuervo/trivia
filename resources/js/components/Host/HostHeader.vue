<template>
    <div class="pr-3 pl-3 host-header">
        <div class="row pt-3 pb-3">
            <div class="col-12 col-md-5 order-2 text-center text-md-left">
                <p class="mb-0 mt-1" v-if="game.description && game.company">{{game.name}}: {{game.description}} @ {{game.company}}</p>
                <p class="mb-0 mt-1" v-else-if="game.description">{{game.name}}: {{game.description}}</p>
                <p class="mb-0 mt-1" v-else>{{game.name}}</p>
            </div>
            <div class="col-12 col-md-3 order-3 order-md-2 text-center text-md-left">
                <p class="mb-0 mt-1">Game Code: <u><b>{{this.gameCode.code}}</b></u></p>
            </div>
            <div class="col-12 col-md-4 float-right offset-md-0 order-1 order-md-3">
<!--                <HostDarkModeIcon></HostDarkModeIcon>-->
                <span class="fa-stack fa-1 first-white then-black clicker float-right pr-2"
                          style="vertical-align: top;"
                          v-b-tooltip.bottom title="Leaderboard"
                          v-b-modal.leaderBoard>
                    <i class="far fa-circle fa-stack-2x"></i>
                    <i class="fas fa-trophy fa-stack-1x"></i>
                </span>
                <span class="fa-stack fa-1 first-white then-black clicker float-right pr-2"
                      style="vertical-align: top;"
                      v-b-tooltip.bottom title="Game Outline"
                      v-b-modal.gameOutline>
                      <i class="far fa-circle fa-stack-2x"></i>
                      <i class="fas fa-list-ol fa-stack-1x"></i>
                    </span>
                <span class="fa-stack fa-1 first-white then-black clicker float-right pr-2"
                      style="vertical-align: top;"
                      v-b-tooltip.bottom title="Team List"
                      v-b-modal.teamList>
                    <i class="far fa-circle fa-stack-2x"></i>
                    <i class="fas fa-user-friends fa-stack-1x"></i>
                </span>
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
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
        }
    }
</script>

<style scoped>

</style>
