<template>
    <div>
        <!--Wait until all of the info of the game has been fetched, then show-->
        <div v-if="!(this.game_id == null)">

            <div class="game-intro">

                <div class="row">

                    <div class="col-md-12">

                        <div class="game-header">

                            <div class="float-right">
                                <button type="button" class="btn"><i class="far fa-edit fa-2x"></i></button>
                            </div>

                            <!--Added layer of protection agaisnt null values-->
                            <div v-if="game.name">
                                <h1>{{ game.name }}</h1>
                            </div>

                            <!--Added layer of protection agaisnt null values-->
                            <div v-if="game.description">
                                <h3 class="text-muted">
                                    {{ game.description }}
                                </h3>
                            </div>
                            <div v-else>
                                <h3 class="text-muted">
                                    Edit to add Description
                                </h3>
                            </div>

                        </div>

                        <hr>
                    </div>

                </div>

            </div>

            <div class="round-outline">
                <RoundIndex></RoundIndex>
            </div>

            <div class="add-Round">
                <AddRound></AddRound>
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
        methods:{
            ...mapActions('game', ['fetchData']),
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id']),
            ...mapGetters('round', ['rounds']),
        }
    }
</script>

<style scoped>

</style>