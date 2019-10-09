<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Edit Game</h1>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <b-input v-model.trim="gameName" v-if="gameName.length <= gameNameCC" placeholder="Trivia gameName"></b-input>
                                <b-input v-model.trim="gameName" :state="!(gameName.length > gameNameCC)" v-else></b-input>
                                <b-form-invalid-feedback :state="!(gameName.length > gameNameCC)" >
                                    {{gameNameCC - gameName.length}}
                                </b-form-invalid-feedback>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description (Optional)</label>
                                <b-input v-model.trim="gameDescription" v-if="gameDescription.length <= gameDescriptionCC" placeholder="Trivia gameDescription"></b-input>
                                <b-input v-model.trim="gameDescription" :state="!(gameDescription.length > gameDescriptionCC)" v-else></b-input>
                                <b-form-invalid-feedback :state="!(gameDescription.length > gameDescriptionCC)" >
                                    {{gameDescriptionCC - gameDescription.length}}
                                </b-form-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company (Optional)</label>
                                <b-input v-model.trim="gameCompany" v-if="gameCompany.length <= gameCompanyCC" placeholder="Trivia gameCompany"></b-input>
                                <b-input v-model.trim="gameCompany" :state="!(gameCompany.length > gameCompanyCC)" v-else></b-input>
                                <b-form-invalid-feedback :state="!(gameCompany.length > gameCompanyCC)" >
                                    {{gameCompanyCC - gameCompany.length}}
                                </b-form-invalid-feedback>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4 pb-4">
                        <div class="col-md-12">
                            <button v-if="validation" @click="saveGame()" class="btn btn-primary float-right">Save Game</button>
                            <button v-if="!validation" disabled class="btn btn-primary float-right">Save Game</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import axios from 'axios';
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                gameName: '',
                gameDescription: '',
                gameCompany: '',
                gameNameCC: 40,
                gameDescriptionCC: 20,
                gameCompanyCC: 20,
            }
        },
        mounted() {
            this.gameName = this.game_name;
            this.gameDescription = this.game_description;
            this.gameCompany = this.game_company;
        },
        methods: {
            ...mapActions('round', ['addRound']),
            ...mapActions('game', ['fetchData', 'updateGame']),

            saveGame(){
                this.updateGame();
                this.game_name = this.gameName;
                this.game_description = this.gameDescription;
                this.game_company= this.gameCompany;
                this.$bvModal.hide('edit-game');
            },
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id']),
            ...mapGetters('user', ['user_id']),
            game_name: {
                get() {
                    return this.game.name;
                },
                set(value){
                    return this.$store.commit('game/UPDATE_GAME_NAME', value);
                }
            },
            game_description: {
                get() {
                    return this.game.description;
                },
                set(value){
                    return this.$store.commit('game/UPDATE_GAME_DESCRIPTION', value);
                }
            },
            game_company: {
                get() {
                    return this.game.company;
                },
                set(value){
                    return this.$store.commit('game/UPDATE_GAME_COMPANY', value);
                }
            },
            //For Validation
            validation() {
                return this.gameName.length > 0 && this.gameName.length <= this.gameNameCC && this.gameDescription.length <= this.gameDescriptionCC && this.gameCompany.length <= this.gameCompanyCC;;
            }
        },

    }
</script>

<style scoped>


</style>

