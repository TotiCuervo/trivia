<template>
    <div>
        <div class="row no-gutters pl-4 pr-4 pt-3">
            <div class="col-12">
                <h5 class="font-weight-normal">Dashboard</h5>
                <hr>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-md-3 col-sm-10 offset-sm-1 offset-md-0 order-2 order-md-1">
                <div class="container-fluid pr-4 pl-4">
                    <div class="row pt-1">
                        <div class="col-12">
                            <div class="d-flex align-items-baseline">
                                <span class="h5">Events Calendar</span>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h1>Calendar</h1>
                                </div>
                                <div class="card-body">
                                    <h1>Calendar and shit</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-10 offset-sm-1 offset-md-0 order-1 order-md-2">
                <div v-if="!(this.user_id == null)">
                    <TriviaIndex></TriviaIndex>
                </div>
            </div>
        </div>



    <!--Modals-->
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

        <b-modal id="create-game" hide-footer centered visible-close>
            <CreateGameName></CreateGameName>
        </b-modal>
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
