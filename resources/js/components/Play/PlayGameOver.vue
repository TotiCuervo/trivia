<template>
    <div class="row pt-3">
        <div class="col-12 text-center">
            <div v-if="myTeam.place === 1">
                <div class="row">
                    <div class="col-12">
                        <div class="fa-10x color-gold">
                            <span class="fa-layers fa-fw" v-bind:class="{'faa-shake animated':shake}">
                                <i class="fas fa-award"></i>
                                <span class="fa-layers-text fa-inverse color-gold" data-fa-transform="shrink-13 up-2.5" style="font-weight:900">1st</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>Congratulations! You came in 1st place!</h3>
                    </div>
                </div>
            </div>
            <div v-else-if="myTeam.place === 2">
                <div class="row">
                    <div class="col-12">
                        <div class="fa-10x color-silver">
                            <span class="fa-layers fa-fw" v-bind:class="{'faa-shake animated':shake}">
                                <i class="fas fa-award"></i>
                                <span class="fa-layers-text fa-inverse color-silver" data-fa-transform="shrink-13 up-2.5" style="font-weight:900">2nd</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>Congratulations! You came in 2nd place!</h3>
                    </div>
                </div>
            </div>
            <div v-else-if="myTeam.place === 3">
                <div class="row">
                    <div class="col-12">
                        <div class="fa-10x color-bronze">
                            <span class="fa-layers fa-fw" v-bind:class="{'faa-shake animated':shake}">
                                <i class="fas fa-award"></i>
                                <span class="fa-layers-text fa-inverse color-bronze" data-fa-transform="shrink-13 up-2.5" style="font-weight:900">3rd</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>Congratulations! You came in 3rd place!</h3>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-12">
                        <i class="fas fa-trophy fa-10x"></i>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-12">
                        <h3 v-if="myTeam[myTeam.length - 1] === 2">You came in {{myTeam.place}}nd!</h3>
                        <h3 v-if="myTeam[myTeam.length - 1] === 3">You came in {{myTeam.place}}rd!</h3>
                        <h3 v-else>You came in {{myTeam.place}}th!</h3>


                    </div>
                    <div class="col-12">
                        <h3>Thank you for playing!</h3>
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
                leaderBoard: [],
                myTeam: '',
                shake: true,
            }
        },
        mounted() {
            this.sortLeaderBoard();
            this.myTeam = this.leaderBoard.find(x => x.id === this.team.id);
            this.toggleShake();
        },
        methods: {
            sortLeaderBoard() {
                this.leaderBoard = [];

                let $place = 1;
                let $points = 0;

                for (let $i = 0; $i < this.teams.length; $i++) {

                    $points = this.teams[$i].points;

                    for (let $b = 0; $b < this.teams.filter(x => x.points === $points).length; $b++) {

                        this.leaderBoard.push({
                            place: $place,
                            name: this.teams.filter(x => x.points === $points)[$b].name,
                            id: this.teams.filter(x => x.points === $points)[$b].id,
                            points: this.teams.filter(x => x.points === $points)[$b].points,
                        });

                        $i++;

                    }

                    $place++;
                    $i--;

                }
            },
            toggleShake() {
                let vm = this;
                setTimeout(function () {
                    vm.shake =  !vm.shake;
                    vm.toggleShake();
                }, 2000);
            }
        },
        watch: {
            teams: function() {
                this.sortLeaderBoard();
            }

        },
        computed: {
            ...mapGetters('team', ['teams', 'team']),
            ...mapGetters('user', ['darkMode']),


        }
    }
</script>

<style scoped>

</style>
