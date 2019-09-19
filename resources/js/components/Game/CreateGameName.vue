<template>
    <div>
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-12 text-center">
                    <h1>New Game</h1>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name"
                                       placeholder="Enter Name" v-model="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description (Optional)</label>
                                <input type="text" class="form-control" id="description" aria-describedby="name"
                                       placeholder="Enter Name" v-model="description">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company (Optional)</label>
                                <input type="text" class="form-control" id="company" aria-describedby="name"
                                       placeholder="Enter Name" v-model="company">
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4 pb-4">
                        <div class="col-md-12">
                            <button @click="newGame()" class="btn btn-primary float-right">Submit</button>
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
                name: null,
                description: null,
                company: null,
                bodyColor: '#FAEDED',
                headClass: 'bc-header-red',

            }
        },
        mounted() {
        },
        methods: {
            ...mapActions('round', ['addRound']),
            newGame(){
                axios.post('/api/game/create',{
                    name: this.name,
                    description: this.description,
                    company: this.company,
                    user_id: this.user_id,
                    headClass: this.headClass,
                    bodyColor: this.bodyColor,
                }).then(response => {
                    let $game = response.data;
                    // this.createGameOrder(game.id);
                    this.$store.commit('round/UPDATE_GAME_ID', $game.id);
                    this.addRound();
                    this.$router.push({ name: "gameDetails", params: { id: $game.id }});
                });
            },
            setRed() {
                this.headClass = 'bc-header-red';
                document.querySelector('body').style.backgroundColor = '#FAEDED';
                this.bodyColor = '#FAEDED';

            },
            setBlue() {
                this.headClass = 'bc-header-blue';
                document.querySelector('body').style.backgroundColor = '#EFF6FA';
                this.bodyColor = '#EFF6FA';

            },
            setGreen() {
                this.headClass = 'bc-header-green';
                document.querySelector('body').style.backgroundColor = '#EFFAF3';
                this.bodyColor = '#EFFAF3';


            },
            setYellow() {
                this.headClass = 'bc-header-yellow';
                document.querySelector('body').style.backgroundColor = '#FFF5D8';
                this.bodyColor = '#FFF5D8';


            },
        },
        computed: {
            ...mapGetters('user', ['user_id']),

        },
    }
</script>

<style scoped>


</style>

<!--v-bind:style="{backgroundColor: headColor}"-->
