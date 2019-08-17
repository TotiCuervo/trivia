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
                            <!--<p>{ this.error === 'alreadyLoggedIn'}}</p>-->
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
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                validCode: '',
                validPassword:'',
                gameCode: '',
                name: '',
                password: '',
                error: ''
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
                        if (response.data === 'unauthorized') {
                            this.error = 'unauthorized';
                            this.validPassword = false;
                        }
                        else if (response.data === 'alreadyLoggedIn') {
                            this.error = 'alreadyLoggedIn';
                            this.validPassword = false;
                        }
                        else {
                            // console.log(response.data);
                            this.loggedTeam = response.data;
                            localStorage.setItem('user-token',  response.data.token);
                            this.$router.push({name: "playInterface"});

                        }
                    });
            },
            resetInput() {

                this.validPassword = '';
                this.error = '';

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