<template>
    <div v-if="this.game.name !== ''">
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
    </div>
</template>

<script>

    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                id: null,
            }
        },
        mounted() {
            //sets the value of id to the id of the game that was created
            this.id = this.$route.params;

            //fetches the information of the game to load it into the details
            this.fetchData(this.id);
        },
        methods: {
            ...mapActions('game', ['fetchData']),
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
        }
    }
</script>

<style scoped>


</style>
