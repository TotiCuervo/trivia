<template>
    <div>
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-8 offset-md-2 text-center pt-5">
                    <h1>Let's Play!</h1>
                </div>
            </div>
            <!--<transition name="fade2">-->
            <!--</transition>-->
            <div class="row pt-5">
                <div class="col-md-4 offset-md-4" v-if="this.validCode !== true">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <label>Play Code:</label>
                            <b-form-input
                                    v-model="gameCode"
                                    :state=validCode
                                    id="play-code"
                                    placeholder="Enter your Play Code"
                                    @click="validCode = ''"
                            ></b-form-input>
                            <b-form-invalid-feedback id="play-code">
                                Sorry :( wrong play code
                            </b-form-invalid-feedback>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offset-md-4" v-if="this.validCode === true">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <label>Team Name:</label>
                            <b-form-input id="team-name" placeholder="Enter your Team Name"></b-form-input>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-8 offset-md-2">
                            <label>Team Password:</label>
                            <b-form-input id="team-password" placeholder="Password"></b-form-input>
                            <b-form-text id="team-password">
                                Create a new team or login
                            </b-form-text>
                        </div>
                    </div>
                </div>
            </div>
            <!--<transition name="fade">-->
                <!--<div class="row pt-5" v-if="this.validCode === true">-->
                    <!--<div class="col-md-4 offset-md-4">-->
                        <!--<div class="row">-->
                            <!--<div class="col-md-8 offset-md-2">-->
                                <!--<label>Team Name:</label>-->
                                <!--<b-form-input id="team-name" placeholder="Enter your Team Name"></b-form-input>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</transition>-->
            <div class="row pt-3">
                <div class="col-md-4 offset-md-4">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <b-button block variant="primary" @click="checkPlayCode()">Let's Play</b-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                gameCode: '',
                validCode: '',
            }
        },
        methods: {
            checkPlayCode() {
                axios.post('/api/play/checkCode', {
                    code: this.gameCode
                } )
                    .then(response => {
                        console.log(response.data);
                        if(response.data === false) {
                            this.validCode = false;
                        }
                        else {
                            console.log('made it');
                            this.validCode = true;
                        }

                    // let $game = response.data;
                    // // this.createGameOrder(game.id);
                    // this.$store.commit('round/UPDATE_GAME_ID', $game.id);
                    // this.addRound();
                    // this.$router.push({ name: "gameDetails", params: { id: $game.id }});
                });
            }
        }
    }
</script>

<style scoped>

</style>