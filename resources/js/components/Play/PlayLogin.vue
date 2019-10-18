<template>
    <div>
        <div class="container">
            <!--Header-->
            <div class="row pt-5">
                <div class="col-md-8 offset-md-2 text-center pt-5">
                    <h1 class="display-3" style="font-family: 'Pacifico', cursive;">Trivalo</h1>
                </div>
            </div>
            <!--Player interaction-->
            <div class="row pt-5">
                <!--Player Code-->
                <div class="col-md-4 offset-md-4" v-if="this.validCode !== true">
                    <label>Play Code:</label>
                    <b-form-input
                            v-model.trim="gameCode"
                            :state=validCode
                            id="play-code"
                            placeholder="Enter your Play Code"
                            @click="validCode = ''"
                    ></b-form-input>
                    <b-form-invalid-feedback id="play-code">
                        Sorry :( wrong play code
                    </b-form-invalid-feedback>
                </div>
                <!--Player Login-->
                <div class="col-md-4 offset-md-4" v-if="this.validCode === true">
                    <!--Team Name-->
                    <div class="row">
                        <div class="col-md-12">
                            <label>Team Name:</label>
                            <b-form-input id="team-name"
                                          placeholder="Enter your Team Name"
                                          v-model="name"
                                          :state="validName"
                                          @input="checkName()">
                            </b-form-input>
                            <b-form-invalid-feedback id="team-name-too-long" v-if="this.validName === false">
                                Sorry, your name is too long
                            </b-form-invalid-feedback>
                        </div>
                    </div>
                    <!--Team Password-->
                    <div class="row pt-3">
                        <div class="col-md-12">
                            <label>Team Password:</label>
                            <b-form-input id="team-password" placeholder="Password" type="password" v-model="password" :state=validPassword @click="resetInput()"> </b-form-input>
                            <b-form-text id="team-password">
                                Create a new team or login
                            </b-form-text>
                            <b-form-invalid-feedback id="team-password" v-if="this.error === 'unauthorized'">
                                Sorry, it seems like this is the wrong password
                            </b-form-invalid-feedback>
                            <b-form-invalid-feedback v-if="this.error === 'alreadyLoggedIn'" id="team-password">
                                Sorry, it seems like someone is already logged in. If this is a mistake, please see the trivia master.
                            </b-form-invalid-feedback>
                        </div>
                    </div>
                </div>
            </div>
            <!--Submit Buttons-->
            <div class="row pt-3">
                <div class="col-md-4 offset-md-4">
                    <b-button block variant="primary" @click="checkPlayCode()" v-if="this.validCode !== true">Check Code</b-button>
                    <b-button block variant="primary" @click="loginOrRegister()" v-if="this.validCode === true && this.validName !== false && !this.clicked ">Let's Play</b-button>
                    <b-button block variant="primary" v-show="this.clicked"><b-spinner small label="Spinning"></b-spinner></b-button>
                    <b-button block disabled variant="primary" @click="loginOrRegister()" v-if="this.validCode === true && this.validName === false ">Let's Play</b-button>
                </div>
            </div>
            <!--Dark Mode-->
            <div class="fixed-bottom">
                <div class="row">
                    <div class="col-4 offset-8">
                        <div class="float-right pr-1">
                            <DarkModeSwitch></DarkModeSwitch>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                validCode: '',
                validPassword:'',
                validName: '',
                gameCode: '',
                name: '',
                password: '',
                error: '',
                clicked: false
            }
        },
        mounted() {

        },
        methods: {
            checkPlayCode() {
                axios.post('/api/team/checkCode', {
                    code: this.gameCode
                })
                    .then(response => {
                        // console.log(response.data);
                        if (response.data === false) {
                            this.validCode = false;
                        }
                        else {
                            this.validCode = true;
                        }
                    });
            },
            loginOrRegister() {
                this.clicked = true;

                let $team = {
                    name: this.name,
                    gameCode: this.gameCode,
                    password: this.password,
                    identifier: this.name+this.gameCode,
                    provider: 'teams'
                };

                axios.post('/api/team/registerOrLogin', $team)
                    .then(response => {
                        if (response.data === 'unauthorized') {
                            this.error = 'unauthorized';
                            this.validPassword = false;
                        }
                        else if (response.data === 'alreadyLoggedIn') {
                            this.error = 'alreadyLoggedIn';
                            this.validPassword = false;
                        }
                        else {
                            this.loggedTeam = response.data;
                            localStorage.setItem('user-token',  response.data.token);
                            this.$router.push({name: "playInterface"});

                        }
                    });

                this.clicked = false;
            },
            resetInput() {
                this.validPassword = '';
                this.error = '';
            },
            checkName() {
                this.validName = (this.name.length <= 30) ? '' : false;
            }
        },
        computed: {
            ...mapGetters('team', ['team', 'token']),
            teamToken: {
                get() {
                    return this.token;
                },
                set(value) {
                    return this.$store.commit('team/SET_TOKEN', value);
                }
            },
            teamName: {
                get() {
                    return this.team.name;
                },
                set(value) {
                    return this.$store.commit('team/SET_NAME', value);
                }
            },
            loggedTeam: {
                get() {
                    return this.team;
                },
                set(value) {
                    return this.$store.commit('team/SET_TEAM', value);
                }
            }
        },
    }
</script>

<style scoped>

</style>
