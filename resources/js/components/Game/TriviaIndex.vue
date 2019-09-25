<template>
    <div class="container-fluid">
        <div class="row pl-4 pr-4 pt-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-baseline">
                            <span class="h5 m-0" style="flex-grow:1">My Games</span>
                            <button type="button" class="btn btn-info float-right" v-b-modal.create-game>New Game</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pl-4 pr-4 pt-4">
            <div class="col-md-12 pb-3" v-for="game in games">
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
