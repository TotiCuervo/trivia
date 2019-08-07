<template>
    <div>
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-8 offset-md-2 text-center pt-5">
                    <h1>Let's Play!</h1>
                    <!--<h1>{{Auth::user()->name}}</h1>-->
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
                            <b-form-input id="team-name" placeholder="Enter your Team Name" v-model="name"></b-form-input>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-8 offset-md-2">
                            <label>Team Password:</label>
                            <b-form-input id="team-password" placeholder="Password" type="password" v-model="password"></b-form-input>
                            <b-form-text id="team-password">
                                Create a new team or login
                            </b-form-text>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-4 offset-md-4">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <b-button block variant="primary" @click="checkPlayCode()" v-if="this.validCode !== true">Check Code</b-button>
                            <b-button block variant="primary" @click="loginOrRegister()" v-if="this.validCode === true">Let's Play</b-button>
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
                validCode: '',
                gameCode: '',
                name: '',
                password: ''
            }
        },
        mounted() {
            // console.log('maee it');
            // axios.get('/api/team')
            //     .then(response => {
            //         console.log(response.data);
            //         // this.$router.push({name: "playLobby"});
            //     });
        },
        methods: {
            checkPlayCode() {
                axios.post('/api/team/checkCode', {
                    code: this.gameCode
                })
                    .then(response => {
                        // console.log(response.data);
                        if(response.data === false) {
                            this.validCode = false;
                        }
                        else {
                            this.validCode = true;
                        }
                    });
            },
            loginOrRegister() {

                let $team = {
                    name: this.name,
                    gameCode: this.gameCode,
                    password: this.password,
                    identifier: this.name+this.gameCode,
                    provider: 'teams'
                };

                axios.post('/api/team/registerOrLogin', $team)
                    .then(response => {
                        console.log(response.data);
                        // this.$router.push({name: "playLobby"});

                        console.log('made it');

                        let $config = {
                            headers: {'Authorization': "bearer " + response.data.access_token}
                        };

                        console.log($config);


                        axios.get('/api/team', $config)
                            .then(response => {
                                console.log(response.data);
                                // this.$router.push({name: "playLobby"});
                            });
                    });


            },
        }
    }
</script>

<style scoped>

</style>