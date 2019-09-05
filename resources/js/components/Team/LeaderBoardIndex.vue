<template>
    <div>
        <div class="row pb-3" v-for="team in this.leaderBoard">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1 pr-0">
                                <h6>{{team.place}}.</h6>
                            </div>
                            <div class="col-md-4">
                                <div class="mx-auto" style="width: 100%;">
                                    <h5>{{team.name}}</h5>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fa-2x">
                                    <span class="fa-layers fa-fw clicker text-really-muted" v-if="team.double === 0" v-b-tooltip.top title="Still available">
                                        <i class="fas fa-certificate"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                              style="font-weight:900">2X</span>
                                    </span>
                                    <span class="fa-layers fa-fw clicker" v-else v-b-tooltip.top title="2X used">
                                        <i class="fas fa-certificate"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                              style="font-weight:900">2X</span>
                                    </span>

                                    <span class="fa-layers fa-fw clicker text-really-muted" v-if="team.triple === 0" v-b-tooltip.top title="Still available">
                                        <i class="fas fa-certificate"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                              style="font-weight:900">3X</span>
                                    </span>
                                    <span class="fa-layers fa-fw clicker text-really-muted" v-else v-b-tooltip.top title="3X used">
                                        <i class="fas fa-certificate"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                              style="font-weight:900">3X</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mx-auto" style="width: 100%;">
                                    <div class="float-right">
                                        {{team.points}} Points
                                    </div>
                                </div>
                            </div>
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
                leaderBoard: []
            }
        },
        mounted() {
            this.sortLeaderBoard();
        },
        methods: {
            sortLeaderBoard() {
                let $place = 1;
                let $points = 0;

                for (let $i = 0; $i < this.teams.length; $i++) {
                    console.log('made it 2');

                    $points = this.teams[$i].points;

                    console.log('points:');
                    console.log($points);

                    console.log('teams');
                    console.log(this.teams.filter(x => x.points === $points));

                    for (let $b = 0; $b < this.teams.filter(x => x.points === $points).length; $b++) {

                        this.leaderBoard.push({
                            place: $place,
                            name: this.teams.filter(x => x.points === $points)[$b].name,
                            id: this.teams.filter(x => x.points === $points)[$b].id,
                            double: this.teams.filter(x => x.points === $points)[$b].double,
                            triple: this.teams.filter(x => x.points === $points)[$b].triple,
                            points: this.teams.filter(x => x.points === $points)[$b].points,
                        });

                        $i++;

                        console.log('Team:');
                        console.log(this.teams.filter(x => x.points === $points)[$b].name);

                    }

                    $place++;
                    $i--;

                }
            }
        },
        computed: {
            ...mapGetters('team', ['teams']),
        },
        watch: {
            teams: function() {
                this.leaderBoard = [];
                this.sortLeaderBoard();
            }

        },
    }
</script>

<style scoped>

</style>