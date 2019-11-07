<template>
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
                            {{nameError}}
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
                <b-button block variant="primary" @click="checkPlayCode()" v-show="this.validCode !== true">Check Code</b-button>
                <b-button block variant="primary" @click="loginOrRegister()" v-show="this.validCode === true && this.validName !== false && !this.clicked && this.password.length > 0">Let's Play</b-button>
                <b-button block variant="primary" v-show="this.clicked"><b-spinner small label="Spinning"></b-spinner></b-button>
                <b-button block disabled variant="primary" @click="loginOrRegister()" v-show="this.validCode === true && (this.validName === false || this.password.length === 0)">Let's Play</b-button>
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
                nameError: '',
                clicked: false
            }
        },
        mounted() {

        },
        methods: {
            checkPlayCode() {
                //checks to see if the gameCode is accurate
                axios.post('/api/team/checkCode', {
                    code: this.gameCode
                }).then(response => {
                        //if not, does not let them continue
                        if (response.data === false) {
                            this.validCode = false;
                        }
                        //if so. lets them continue in the process
                        else {
                            this.validCode = true;
                        }
                    });
            },
            loginOrRegister() {
                //Sets the spinning wheel
                this.clicked = true;

                //creates the team to be sent to the database
                let $team = {
                    name: this.name,
                    gameCode: this.gameCode,
                    password: this.password,
                    identifier: this.name+this.gameCode,
                    provider: 'teams'
                };

                //checks to see if the player is registered or logged in
                axios.post('/api/team/registerOrLogin', $team)
                    .then(response => {

                        console.log(response);
                        console.log(response.data.team);

                        //if it is unauthorized, throw unauthorized error
                        if (response.data === 'unauthorized') {
                            this.error = 'unauthorized';
                            this.validPassword = false;
                        }
                        //if it is alreadyLoggedIn, throw alreadyLoggedIn error
                        else if (response.data === 'alreadyLoggedIn') {
                            this.error = 'alreadyLoggedIn';
                            this.validPassword = false;
                        }
                        //else, log them into the game
                        else {
                            this.loggedTeam = response.data.team;
                            this.$store.commit('game/SET_GAME', response.data.game);
                            this.$store.commit('round/SET_ROUNDS', response.data.rounds);
                            this.$store.commit('question/SET_QUESTIONS', response.data.questions);
                            this.$store.commit('answer/SET_ANSWERS', response.data.answers);
                            this.$store.commit('team/SET_TEAM_ANSWERS', response.data.teamAnswers);
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
                if (this.name.length > 0) {
                    if (!this.name.match("^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$")) {
                        this.nameError = 'No special characters or symbols allowed';
                        this.validName = false;
                    } else if (!(this.name.length <= 30)){
                        this.nameError = 'Sorry, your name is too long';
                        this.validName = false;
                    } else if (this.name === '') {
                        this.validName = '';
                    } else {
                        this.validName = '';
                    }
                } else {
                    this.validName = '';
                }
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
            },
        },
    }
</script>

<style scoped>

</style>
