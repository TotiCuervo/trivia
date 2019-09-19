<template>
    <div>
        <div class="row pl-4 pr-4 pt-3">
            <div class="col-md-4">
                <h3>My Games</h3>
                <hr>
            </div>
        </div>
        <div class="row pl-4 pr-4">
            <div class="col-md-3 pb-3">
<!--                <router-link :to="{ name: 'createGameName' }">-->
<!--                    <div class="fancy-2 card" style="padding:20px;">-->
<!--                        <div class="card-body">-->
<!--                            <div class="container">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-12 text-center">-->
<!--                                        <span class="color-blue fa-3x"><i class="fas fa-plus"></i></span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-12 text-center">-->
<!--                                        <small class="text-muted">Add a new Trivia Game!</small>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </router-link>-->
                <div class="fancy-2 card clicker" style="padding:20px;" v-b-modal.create-game>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <span class="color-blue fa-3x"><i class="fas fa-plus"></i></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <small class="text-muted">Add a new Trivia Game!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 pb-3" v-for="game in games">
                <GameCard :game="game"></GameCard>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                // games: [],
                id: null,
            }
        },
        mounted() {

            this.fetchGames(this.user_id);

        },
        methods: {
            ...mapActions('user', ['fetchData']),
            ...mapActions('game', ['fetchGames']),
        },
        computed: {
            ...mapGetters('user', ['user_id']),
            ...mapGetters('game', ['games']),
        },
    }
</script>

<style>


</style>
