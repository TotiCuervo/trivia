<template>
    <div>
        <div class="game-intro pt-4 pb-4">

            <div class="row no-gutters">

                <div class="col-md-12 text-center">

                    <div class="game-header">

                        <div v-if="game.name">
                            <h1>{{ game.name }}</h1>
                        </div>

                        <!--Added layer of protection agaisnt null values-->
                        <div v-if="game.description">
                            <h3>
                                {{ game.description }}
                            </h3>
                        </div>
                        <div v-else>
                            <h3 class="text-muted">
                                Edit to add Description
                            </h3>
                        </div>

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
            ...mapGetters('game', ['game', 'game_id']),
        }
    }
</script>

<style scoped>

</style>