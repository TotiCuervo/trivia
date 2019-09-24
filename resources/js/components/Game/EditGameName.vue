<template>
    <div>
        <div class="container">
            <div class="row pt-5">
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
                                <input type="text" class="form-control" id="name" aria-describedby="name"
                                       placeholder="Enter Name" v-model="game_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description (Optional)</label>
                                <input type="text" class="form-control" id="description" aria-describedby="name"
                                       placeholder="Enter Name" v-model="game_description">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company (Optional)</label>
                                <input type="text" class="form-control" id="company" aria-describedby="name"
                                       placeholder="Enter Name" v-model="game_company">
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4 pb-4">
                        <div class="col-md-12">
                            <button @click="saveGame()" class="btn btn-primary float-right">Save Game</button>
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

            }
        },
        mounted() {

        },
        methods: {
            ...mapActions('round', ['addRound']),
            ...mapActions('game', ['fetchData', 'updateGame']),

            saveGame(){
                this.updateGame();
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
        },

    }
</script>

<style scoped>


</style>

