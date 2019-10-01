<template>
    <div>
        <div class="row no-gutters pl-4 pr-4 pt-4 pb-2">
            <div class="col-12">
                <h5 class="font-weight-normal">Dashboard</h5>
                <hr>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-md-4 col-sm-10 offset-sm-1 offset-md-0 order-2 order-md-1">
                <div class="container-fluid pr-4 pl-4">
                    <div class="row pt-3">
                        <div class="col-12">
                            <div class="d-flex align-items-baseline">
                                <span class="h5">Events Calendar</span>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-1">
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
            <div class="col-md-8 col-sm-10 offset-sm-1 offset-md-0 order-1 order-md-2">
                <div v-if="!(this.user_id == null)">
                    <TriviaIndex></TriviaIndex>
                </div>
            </div>
        </div>



    <!--Modals-->
        <b-modal id="delete-game" hide-footer centered visible-close>
            <template slot="default" slot-scope="{ close }">
                <div class="container pr-4 pl-4">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="">Delete Game</h3>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-12">
                            <p class="pt-3">Are you sure you want to delete this <b>Game?</b> Doing so will result in losing all rounds, question, and answers as well. <b>This cannot be undone.</b></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row trivalo-background p-3" style="border-radius: 0.3rem;">
                        <div class="col-2 offset-6">
                            <button type="button" class="btn btn-link text-decoration-none" @click="close()"><span class="color-black">Cancel</span></button>
                        </div>
                        <div class="col-4">
                            <b-button class="float-right" block variant="danger" @click="delete_Game()">Delete</b-button>
                        </div>
                    </div>
                </div>
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
