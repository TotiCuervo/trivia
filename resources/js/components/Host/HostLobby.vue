<template>
    <div>
        <div class="row pb-4">
            <div class="col-md-10">
                <h3>Teams: {{this.teams.length}} Teams</h3>
            </div>
            <div class="col-md-2">
                <div class="float-right">
                    <p class="mb-0">Show Game:</p>
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" @click="toggleShowGame()">
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="this.showGame === false">
            <div class="col-md-12">
                <GameTeamIndex></GameTeamIndex>
            </div>
        </div>
        <div class="row" v-if="this.showGame === true">
            <div class="col-md-6 text-center">
            <GameTeamIndex></GameTeamIndex>
            </div>
            <div class="col-md-6 vl">
            <h1 class="text-center pb-3">Game outline</h1>
            <HostGameOutline></HostGameOutline>
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
                showGame: false,
            }
        },
        mounted() {
            this.params = this.$route.params;
            this.fetchData(this.params);

            //get the game code
            axios.get('/api/game/' + this.params.id + '/gameCode', {
            })
                .then(response => {

                    if (response.data === false) {
                        axios.post('/api/gameCode/' + this.params.id + '/create', {
                        })
                            .then(response => {
                                this.game_code = response.data;
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    } else {
                        // console.log(response.data);
                        this.game_code = response.data[0];
                    }

                })
                .catch(error => {
                    console.log(error);
                });

        },
        beforeDestroy() {

            //changes the value to false
            axios.post('/api/game/' + this.game.id + '/gameOver', {
                _method: 'patch'
            })
                .then(response => {
                    // console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        methods: {
            ...mapActions('game', ['fetchData']),

            toggleShowGame() {
                this.showGame = ! this.showGame;
            }

        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('team', ['teams']),
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