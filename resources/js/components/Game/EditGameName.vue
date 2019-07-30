<template>
    <div>
        <div class="row no-gutters">
            <div class="game-header text-center col-md-12 pt-5 pb-5" v-bind:class="[game_headClass]">
                <h1>Edit Game</h1>
            </div>
        </div>
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-6 offset-md-3">
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
                    <div class="row">
                        <div class="col-md-12">
                            <label>Pick Color Scheme</label>
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-md-2 offset-md-2 text-center">
                            <i class="fas fa-circle fa-2x" style="color: #D1504F;" @click="setRed()" v-if=" game_headClass !== 'bc-header-red' "></i>
                            <i class="fas fa-circle fa-stack-2x" style="color: #D1504F;" v-if=" game_headClass === 'bc-header-red' "></i>
                            <i class="far fa-circle fa-stack-2x" v-if=" game_headClass === 'bc-header-red' "></i>
                        </div>
                        <div class="col-md-2 text-center">
                            <i class="fas fa-circle fa-2x" style="color: #4FA1D1;" @click="setBlue()" v-if=" game_headClass !== 'bc-header-blue' "></i>
                            <i class="fas fa-circle fa-stack-2x" style="color: #4FA1D1;" @click="setBlue()" v-if=" game_headClass === 'bc-header-blue' "></i>
                            <i class="far fa-circle fa-stack-2x" v-if=" game_headClass === 'bc-header-blue' "></i>

                        </div>
                        <div class="col-md-2 text-center">
                            <i class="fas fa-circle fa-2x" style="color: #4FD17C;" @click="setGreen()" v-if=" game_headClass !== 'bc-header-green' "></i>
                            <i class="fas fa-circle fa-stack-2x" style="color: #4FD17C;" @click="setGreen()" v-if=" game_headClass === 'bc-header-green' "></i>
                            <i class="far fa-circle fa-stack-2x" v-if=" game_headClass === 'bc-header-green' "></i>

                        </div>
                        <div class="col-md-2 text-center">
                            <i class="fas fa-circle fa-2x" style="color: #FFCD2B;" @click="setYellow()" v-if=" game_headClass !== 'bc-header-yellow' "></i>
                            <i class="fas fa-circle fa-stack-2x" style="color: #FFCD2B;" @click="setYellow()" v-if=" game_headClass === 'bc-header-yellow' "></i>
                            <i class="far fa-circle fa-stack-2x" v-if=" game_headClass === 'bc-header-yellow' "></i>

                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-12">
                            <button @click="save_Game()" class="btn btn-primary">Save</button>
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
            //sets the value of id to the id of the game that was created
            this.id = this.$route.params;

            //fetches the information of the game to load it into the details
            this.fetchData(this.id);

        },
        methods: {
            ...mapActions('round', ['addRound']),
            ...mapActions('game', ['fetchData', 'updateGame']),

            save_Game(){
                this.updateGame();
                this.$router.push({ name: "gameDetails", params: { id: this.game.id }});
            },
            setRed() {
                this.game_headClass = 'bc-header-red';
                document.querySelector('body').style.backgroundColor = '#FAEDED';
                this.game_bodyColor = '#FAEDED';

            },
            setBlue() {
                this.game_headClass = 'bc-header-blue';
                document.querySelector('body').style.backgroundColor = '#EFF6FA';
                this.game_bodyColor = '#EFF6FA';

            },
            setGreen() {
                this.game_headClass = 'bc-header-green';
                document.querySelector('body').style.backgroundColor = '#EFFAF3';
                this.game_bodyColor = '#EFFAF3';


            },
            setYellow() {
                this.game_headClass = 'bc-header-yellow';
                document.querySelector('body').style.backgroundColor = '#FFF5D8';
                this.game_bodyColor = '#FFF5D8';


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
            game_headClass: {
                get() {
                    return this.game.headClass;
                },
                set(value){
                    return this.$store.commit('game/UPDATE_GAME_HEAD_CLASS', value);
                }
            },
            game_bodyColor: {
                get() {
                    return this.game.bodyColor;
                },
                set(value){
                    return this.$store.commit('game/UPDATE_GAME_BODY_COLOR', value);
                }
            }

        },
        beforeDestroy() {
            document.querySelector('body').style.backgroundColor = '';
        },
        watch: {
            game: function () {
                document.querySelector('body').style.backgroundColor = this.game.bodyColor;
            }
        }
    }
</script>

<style scoped>


</style>

<!--v-bind:style="{backgroundColor: headColor}"-->