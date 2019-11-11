<template>
    <div class="row pt-5">
        <div class="col-md-6 offset-md-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>{{this.game.name}} Trivia</h3>
                </div>
            </div>
            <div class="row pt-2" v-if="this.game.company">
                <div class="col-md-12 text-center">
                    <h5><i>{{this.game.company}}</i></h5>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-12 text-center pt-5">
                    <vue-loaders-pacman v-if="!darkMode" scale="1.5" color="black"></vue-loaders-pacman>
                    <vue-loaders-pacman v-if="darkMode" scale="1.5" color="white"></vue-loaders-pacman>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-12 text-center">
                    <h5>This game will begin shortly</h5>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-12 text-center pt-5 pb-3">
                    <h5 v-show="!darkMode">Currently in Light Mode</h5>
                    <h5 v-show="darkMode">Currently in Dark Mode</h5>
                </div>
                <div class="col-md-12 text-center pb-3" v-show="darkMode">
                    <i class="far fa-moon fa-5x"></i>
                </div>
                <div class="col-md-12 text-center pb-3" v-show="!darkMode">
                    <i class="far fa-sun fa-5x"></i>
                </div>
                <div class="col-md-12 text-center">
                    <h5 v-show="!darkMode">Tap Team Name to activate Dark Mode</h5>
                    <h5 v-show="darkMode">Tap Team Name to activate Light Mode</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <b-button block variant="primary" @click="setGame()">Let's Play</b-button>
                </div>
            </div>
<!--            <div class="card trivalo-card" v-bind:class="{'darkMode-card': darkMode}">-->
<!--                <div class="card-body py-5">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 text-center">-->
<!--                            <h3>{{this.game.name}} Trivia</h3>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row pt-2" v-if="this.game.company">-->
<!--                        <div class="col-md-12 text-center">-->
<!--                            <h5><i>{{this.game.company}}</i></h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row pt-5">-->
<!--                        <div class="col-md-12 text-center">-->
<!--                            <vue-loaders-pacman v-if="!darkMode" scale="1.5" color="black"></vue-loaders-pacman>-->
<!--                            <vue-loaders-pacman v-if="darkMode" scale="1.5" color="white"></vue-loaders-pacman>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row pt-3">-->
<!--                        <div class="col-md-12 text-center">-->
<!--                            <h5>This game will begin shortly</h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row pt-5">-->
<!--                        <div class="col-md-12 text-center pb-3">-->
<!--                            <h5 v-show="!darkMode">Currently in Light Mode</h5>-->
<!--                            <h5 v-show="darkMode">Currently in Dark Mode</h5>-->
<!--                        </div>-->
<!--                        <div class="col-md-12 text-center pb-3" v-show="darkMode">-->
<!--                            <i class="far fa-moon fa-5x"></i>-->
<!--                        </div>-->
<!--                        <div class="col-md-12 text-center pb-3" v-show="!darkMode">-->
<!--                            <i class="far fa-sun fa-5x"></i>-->
<!--                        </div>-->
<!--                        <div class="col-md-12 text-center">-->
<!--                            <h5 v-show="!darkMode">Tap Team Name to activate Dark Mode</h5>-->
<!--                            <h5 v-show="darkMode">Tap Team Name to activate Light Mode</h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--&lt;!&ndash;                    <div class="row pt-3">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col-md-12 text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                            <h5>Want to play in Dark Mode? Tap your team name to activate Dark Mode!</h5>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        <i class="far fa-moon fa-3x"></i>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {

            }
        },
        methods: {
            setGame() {
                axios.post('/api/team/logout/'+ this.team.id);
                this.$store.commit('play/SET_LOGGED_IN', false);
            }
        },
        computed: {
            ...mapGetters('game', ['game']),
            ...mapGetters('user', ['darkMode']),
            ...mapGetters('team', ['team', 'teamAnswers']),

        }
    }
</script>

<style scoped>

</style>
