<template>
    <div>
        <!--Wait until all of the info of the game has been fetched, then show-->
        <div v-if="!(this.game_id == null)">

            <div class="game-intro">

                <div class="row">

                    <div class="col-md-12 text-center">

                        <div class="game-header">

                            <div class="row">
                                <div class="col-md-11 col-sm-11">
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
                                <div class="col-md-1 col-sm-1">
                                    <i class="fas fa-ellipsis-v circle-icon" aria-hidden="true"></i>
                                </div>
                            </div>


                            <!--&lt;!&ndash;Added layer of protection agaisnt null values&ndash;&gt;-->
                            <!--<div v-if="game.name">-->
                                <!--<h1>{{ game.name }}</h1>-->
                            <!--</div>-->

                            <!--&lt;!&ndash;Added layer of protection agaisnt null values&ndash;&gt;-->
                            <!--<div v-if="game.description">-->
                                <!--<h3 class="text-muted">-->
                                    <!--{{ game.description }}-->
                                <!--</h3>-->
                            <!--</div>-->
                            <!--<div v-else>-->
                                <!--<h3 class="text-muted">-->
                                    <!--Edit to add Description-->
                                <!--</h3>-->
                            <!--</div>-->

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