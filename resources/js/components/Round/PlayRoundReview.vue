<template>
    <div>
        <!--Round Header-->
        <div class="row pt-3">
            <div class="col-md-12 text-center">
                <h3>Round {{this.rounds[this.roundPosition].order_number}} Answers:</h3>
            </div>
        </div>
        <!--Question index-->
        <div v-for="question in this.questions.filter(x => x.round_id === this.rounds[roundPosition].id)">
            <div class="row pt-3">
                <div class="col-12 col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row pt-2">
                                <div class="col-md-12">
                                    <p><b>Question {{question.order_number}}: </b> {{question.title}} </p>
                                </div>
                                <div class="col-md-12">
                                    <div v-if="teamAnswers.find(x => x.question_id === question.id)">
                                        <p class="m-0"><b>Answer:</b> {{teamAnswers.find(x => x.question_id === question.id).answer}}</p>
                                    </div>
                                    <div v-else>
                                        <p class="m-0">No Answer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Round Modifier-->
        <div class="row pt-3">
            <div class="col-md-6 offset-md-3 text-center">
                <div class="row">
                    <div class="col-12 pb-3 pt-3">
                        <h5 class="m-0" v-if="this.clickedPowerUp === ''">
                            Feeling Lucky?
                        </h5>
                        <h5 class="m-0" v-if="this.clickedPowerUp !== ''">
                            {{clickedPowerUp}} Points This Round
                        </h5>
                    </div>
                    <div class="col-6 pr-1" v-if="!undo">
                        <button type="button" class="btn btn-dark btn-block" v-if="this.clickedPowerUp === '' && !(this.double)" @click="setPowerUp('Double')">2X Points</button>
                        <button type="button" class="btn btn-dark btn-block" disabled v-else-if="this.clickedPowerUp === '' && this.double">2X Used</button>
                        <button type="button" class="btn btn-dark btn-block" v-else-if="this.clickedPowerUp !== ''" @click="updatePowerUp">Yes</button>
                    </div>
                    <div class="col-6 pl-1" v-if="!undo">
                        <button type="button" class="btn btn-dark btn-block" v-if="this.clickedPowerUp ==='' && !(this.triple)" @click="setPowerUp('Triple')">3X Points</button>
                        <button type="button" class="btn btn-dark btn-block" disabled v-if="this.clickedPowerUp ==='' && this.triple">3X Points</button>
                        <button type="button" class="btn btn-dark btn-block" v-if="this.clickedPowerUp !==''" @click="clickedNo()">No</button>
                    </div>
                    <div class="col-12" v-if="undo">
                        <button type="button" class="btn btn-dark btn-block" @click="undoPowerUp()">Undo</button>
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
                clickedPowerUp: '',
                undo: false,
            }
        },
        mounted() {

        },
        methods: {
            setPowerUp(powerUp) {

                this.clickedPowerUp = powerUp;

            },
            clickedNo() {
                this.clickedPowerUp = '';
            },
            updatePowerUp() {
                axios.post('/api/team/'+ this.loggedTeam.id +'/round/'+ this.rounds[this.roundPosition].id +'/powerUp/'+this.clickedPowerUp)
                    .then(response => {
                        this.undo = true;
                        this.loggedTeam = response.data;
                    });
            },
            undoPowerUp() {
                axios.post('/api/team/'+ this.loggedTeam.id +'/round/'+ this.rounds[this.roundPosition].id +'/undo/'+this.clickedPowerUp)
                    .then(response => {
                        this.undo = false;
                        this.clickedPowerUp = '';
                        this.loggedTeam = response.data;
                    });

            }

        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('team', ['team','teamAnswers', 'double', 'triple']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
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
