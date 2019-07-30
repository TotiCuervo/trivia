<template>
    <div>
        <div class="row no-gutters">
            <div class="col-md-10">
                <div v-if="!(this.user_id == null)">
                    <TriviaIndex></TriviaIndex>
                </div>
            </div>
            <div class="col-md-2" style="background-color: black; height: 100vh;">
                Hello World
            </div>
        </div>
        <div class="modals">
            <b-modal id="delete-game" hide-footer hide-header centered visible-close>
                <template slot="default" slot-scope="{ close }">
                    <div class="row">
                        <div class="col-md-12">
                            <i class="fas fa-times float-right clicker" @click="close()"></i>
                        </div>
                    </div>
                    <div class="d-block text-center">
                        <h4 class="my-4">Are you sure you want to delete this <b>Game?</b></h4>
                    </div>
                    <b-button class="mt-3" block variant="danger" @click="delete_Game()">Delete Game?</b-button>
                </template>
            </b-modal>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                games: [],
                id: null,
            }
        },
        created() {

        },
        methods: {
            ...mapActions('user', ['fetchData']),
            ...mapActions('game', ['deleteGame']),

            delete_Game() {
                this.deleteGame();
                this.$bvModal.hide("delete-game");
            },
        },
        computed: {
            ...mapGetters('user', ['user_id']),
            ...mapGetters('game', ['game']),

        },
    }
</script>

<style scoped>

</style>