<template>
    <div>
        <!--Wait until all of the info of the game has been fetched, then show-->
        <div class="game-creator" v-if="!(this.game_id == null)">

            <div class="pt-4">
                <GameHeader></GameHeader>
            </div>
            <!--<hr>-->
            <div class="round-outline pt-2" v-if="this.loaded === true">
                <RoundIndex></RoundIndex>
            </div>

            <div class="add-Round">
                <AddRound></AddRound>
            </div>
        </div>


        <b-modal id="delete-round"  hide-footer  centered visible-close>
            <template slot="default" slot-scope="{ close }">
                <div class="container pr-4 pl-4">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="">Delete Round</h3>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-12">
                            <p class="pt-3">Are you sure you want to delete this <b>Round?</b> Doing so will result in losing all question and answers as well. <b>This cannot be undone.</b></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row trivalo-background p-3" style="border-radius: 0.3rem;">
                        <div class="col-2 offset-6">
                            <button type="button" class="btn btn-link text-decoration-none" @click="close()"><span class="color-black">Cancel</span></button>
                        </div>
                        <div class="col-4">
                            <b-button class="float-right" block variant="danger" @click="delete_Round()">Delete</b-button>
                        </div>
                    </div>
                </div>
            </template>
        </b-modal>
        <b-modal id="delete-question" hide-footer centered visible-close>
            <template slot="default" slot-scope="{ close }">
                <div class="container pr-4 pl-4">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="">Delete Question</h3>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-12">
                            <p class="pt-3">Are you sure you want to delete this <b>Question?</b> Doing so will result in losing all answers as well. <b>This cannot be undone.</b></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row trivalo-background p-3" style="border-radius: 0.3rem;">
                        <div class="col-2 offset-6">
                            <button type="button" class="btn btn-link text-decoration-none" @click="close()"><span class="color-black">Cancel</span></button>
                        </div>
                        <div class="col-4">
                            <b-button class="float-right" block variant="danger" @click="delete_Question()">Delete</b-button>
                        </div>
                    </div>
                </div>
            </template>
        </b-modal>
        <b-modal id="add-question"  ref="add-question" hide-footer centered visible-close>
            <CreateQAFormModal></CreateQAFormModal>
        </b-modal>
        <b-modal id="edit-question"  hide-footer centered visible-close>
            <EditQAFormModal></EditQAFormModal>
        </b-modal>
        <b-modal id="edit-game"  hide-footer centered visible-close>
            <EditGameName></EditGameName>
        </b-modal>

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

            console.log(this.token);

            //fetches the information of the game to load it into the details
            this.fetchData(this.id);

            this.fetchRounds(this.id);
            this.round_game_id = this.game_id;
            // this.round_type = 'play';

            //for Questions
            this.fetchQuestions(this.id.id);

            //for Answers
            this.fetchAnswers(this.id.id);

            // document.querySelector('body').style.backgroundColor = '#EFFAF3';

        },
        methods:{
            ...mapActions('game', ['fetchData']),
            ...mapActions('round', ['deleteRound', 'fetchRounds']),
            ...mapActions('question', ['fetchQuestions','deleteQuestion']),
            ...mapActions('answer', ['fetchAnswers']),
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
            ...mapGetters('round', ['rounds','formGameID']),
            ...mapGetters('question', ['questions', 'loaded']),
            questionLoaded: {
                get() {
                    return this.loaded;
                }
            },
            gameRounds: {
                get() {
                    return this.rounds;
                }
            },
            round_game_id: {
                get() {
                    return this.formGameID;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_GAME_ID', value);
                }
            }
        },
    }
</script>

<style scoped>


</style>
