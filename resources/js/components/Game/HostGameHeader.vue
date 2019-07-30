<template>
    <div v-if="this.game.name !== ''">
        <div class="game-intro pt-2 pb-2">

            <div class="row no-gutters">

                <div class="col-md-12">

                    <div class="game-header">

                        <div v-if="game.name">
                            <div v-if="game.description">
                                <h5>
                                    {{ game.name}}: {{ game.description }}
                                </h5>
                            </div>
                            <div v-else>
                                <h5>
                                    {{ game.name }}
                                </h5>
                            </div>

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