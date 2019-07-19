<template>
    <div>
        <!--Wait until all of the info of the game has been fetched, then show-->
        <div class="game-creator" v-if="!(this.game_id == null)">

            <div class="game-intro pt-4 pb-4">

                <div class="row">

                    <div class="col-md-12 text-center">

                        <div class="game-header">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <!--Added layer of protection agaisnt null values-->
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
            </div>
            <!--<hr>-->
            <div class="round-outline pt-4">
                <RoundIndex></RoundIndex>
            </div>

            <div class="add-Round">
                <AddRound></AddRound>
            </div>

            <div class="delete-modals">
                <b-modal id="delete-round"  hide-footer hide-header centered visible-close>
                    <template slot="default" slot-scope="{ close }">
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fas fa-times float-right clicker" @click="close()"></i>
                            </div>
                        </div>
                        <div class="d-block text-center">
                            <h4 class="my-4">Are you sure you want to delete this <b>Round?</b></h4>
                        </div>
                        <b-button class="mt-3" block variant="danger" @click="delete_Round()">Delete Round</b-button>
                    </template>
                </b-modal>
                <b-modal id="delete-question" hide-footer hide-header centered visible-close>
                    <template slot="default" slot-scope="{ close }">
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fas fa-times float-right clicker" @click="close()"></i>
                            </div>
                        </div>
                        <div class="d-block text-center">
                            <h4 class="my-4">Are you sure you want to delete this <b>Question?</b></h4>
                        </div>
                        <b-button class="mt-3" block variant="danger" @click="delete_Question()">Delete Question</b-button>
                    </template>
                </b-modal>
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
            ...mapActions('round', ['deleteRound']),
            ...mapActions('question', ['deleteQuestion']),
            delete_Round() {
                this.deleteRound();
                this.$bvModal.hide("delete-round");
            },
            delete_Question() {
                this.deleteQuestion();
                this.$bvModal.hide("delete-question");
            },

        },
        computed: {
            ...mapGetters('game', ['game', 'game_id']),
            ...mapGetters('round', ['rounds']),
        }
    }
</script>

<style scoped>

</style>