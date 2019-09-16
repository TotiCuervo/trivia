<template>
    <div>
        <!--Round Header-->
        <div class="row pt-3">
            <div class="col-md-12 text-center">
                <h3>Round {{this.rounds[this.roundPosition].order_number}} Answers</h3>
            </div>
        </div>
        <!--Question index-->
        <div v-for="question in this.questions.filter(x => x.round_id === this.rounds[roundPosition].id)">
            <div class="row pt-3">
                <div class="col-md-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            <p>{{question.title}}</p>
                            <div v-if="teamAnswers.find(x => x.question_id === question.id)">
                                <small>{{teamAnswers.find(x => x.question_id === question.id).answer}}</small>
                            </div>
                            <div v-else>
                                <small>No answer :(</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Round Modifier-->
        <div class="row pt-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                        <div class="fa-4x">

                            <!--Double Badges-->
                            <span class="fa-layers fa-fw clicker text-muted" v-if="this.clickedPowerUp !=='Double' && !(this.double)" @click="setPowerUp('Double')">
                                <i class="fas fa-certificate"></i>
                                <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                      style="font-weight:900">2X</span>
                            </span>
                            <span class="fa-layers fa-fw clicker" v-if="this.clickedPowerUp === 'Double'">
                                <i class="fas fa-certificate"></i>
                                <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                      style="font-weight:900">2X</span>
                            </span>
                            <span class="fa-layers fa-fw clicker text-really-muted" v-if="this.double && this.clickedPowerUp !== 'Double'" v-b-tooltip.bottom title="2X used">
                                <i class="fas fa-certificate"></i>
                                <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                      style="font-weight:900">2X</span>
                            </span >

                            <!--Triple Badges-->
                            <span class="fa-layers fa-fw clicker text-muted" v-if="this.clickedPowerUp !=='Triple' && !(this.triple) " @click="setPowerUp('Triple')">
                                <i class="fas fa-certificate"></i>
                                <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                      style="font-weight:900">3X</span>
                            </span>
                            <span class="fa-layers fa-fw clicker" v-if="this.clickedPowerUp ==='Triple'">
                                <i class="fas fa-certificate"></i>
                                <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                      style="font-weight:900">3X</span>
                            </span>
                            <span class="fa-layers fa-fw clicker text-really-muted" v-if="this.triple && this.clickedPowerUp !== 'Triple'" v-b-tooltip.bottom title="3X used">
                                <i class="fas fa-certificate"></i>
                                <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                      style="font-weight:900">3X</span>
                            </span>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center" v-if="this.clickedPowerUp !== ''">
                        <b-button variant="success" @click="updatePowerUp" v-if="undo === false">{{clickedPowerUp}} Points This Round</b-button>
                        <b-button variant="success" @click="updatePowerUp" v-else><i class="fas fa-undo-alt"></i> Undo</b-button>

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
                if (this.undo === false) {
                    this.clickedPowerUp = (this.clickedPowerUp === powerUp) ? '' : powerUp;
                }
            },
            updatePowerUp() {

                let $powerUp = (this.undo === false) ? this.clickedPowerUp : 'Null';

                console.log('this.teamAnswers[0].team_id');
                console.log(this.teamAnswers[0].team_id);

                console.log('this.team');
                console.log(this.team);

                axios.post('/api/team/'+ this.loggedTeam.id +'/round/'+ this.rounds[this.roundPosition].id +'/powerUp/'+$powerUp)
                    .then(response => {
                        this.undo = !(this.undo);
                        this.clickedPowerUp = (this.undo === false) ? '' : this.clickedPowerUp;
                        this.loggedTeam = response.data;
                    });

                // if (this.undo === true) {
                //     if (this.clickedPowerUp === 'Double') {
                //         this.teamDouble = 0;
                //     } else {
                //         this.teamTriple = 0;
                //     }
                // } else {
                //     if ($powerUp === 'Double') {
                //         this.teamDouble = 1;
                //     } else {
                //         this.teamTriple = 1;
                //     }
                // }

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