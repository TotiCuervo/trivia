<template>
    <div>
        <div class="row pt-3">
            <div class="col-md-12 text-center">
                <h3>Round {{this.rounds[this.roundPosition].order_number}} Answers</h3>
            </div>
        </div>
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
        <div class="row pt-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center" v-if="this.double === 0">
                        <div class="fa-4x">
                            <span class="fa-layers fa-fw clicker" v-bind:class="{'text-muted': clickedPowerUp !== 'Double'}"
                                  @click="setPowerUp('Double')">
                                <i class="fas fa-certificate"></i>
                                <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                      style="font-weight:900">2X</span>
                            </span>
                            <span class="fa-layers fa-fw clicker" v-bind:class="{'text-muted': clickedPowerUp !== 'Triple'}"
                                  @click="setPowerUp('Triple')">
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

                axios.post('/api/team/'+ this.teamAnswers[0].team_id +'/round/'+ this.rounds[this.roundPosition].id +'/powerUp/'+$powerUp)
                    .then(response => {
                        console.log(response.data);
                        this.undo = !(this.undo);
                        this.clickedPowerUp = (this.undo === false) ? '' : this.clickedPowerUp;
                    });
            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('team', ['teamAnswers', 'double', 'triple']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
        },
    }
</script>

<style scoped>

</style>