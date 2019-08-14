<template>
    <div class="pr-3 pl-3" v-if="this.game_code">
        <div class="row pt-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div v-if="game.description">
                            <h3>
                                {{ game.name}}: {{ game.description }}
                            </h3>
                        </div>
                        <div v-else>
                            <h3>
                                {{ game.name }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <h5>This Trivia game can be joined using this code: <u><b>{{this.gameCode.code}}</b></u></h5>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right">
                            <button type="button" class="btn btn-success btn-lg mr-2">Start Game</button>

                            <button type="button" class="btn btn-outline-secondary mr-2">
                                <i class="fas fa-edit fa-2x"></i>
                            </button>

                            <button type="button" class="btn btn-outline-danger">
                                <i class="fas fa-door-open fa-2x"></i>
                            </button>
                        </div>

                    </div>
                </div>
                <hr>
            </div>
        </div>
        <HostLobby></HostLobby>
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