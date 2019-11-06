<template>
    <div>

        <div class="row pt-3 pb-3">
            <div class="col-md-12 text-center">
                <h3>Leaderboard:</h3>
            </div>
        </div>
        <div class="row pb-3" v-for="team in this.leaderBoard">
            <div class="col-md-6 offset-md-3">
                <div class="card" v-bind:class="{isChosen: team.id === loggedTeam.id && !darkMode, 'darkMode-card': team.id !== loggedTeam.id && darkMode, 'darkMode-answer-card': team.id === loggedTeam.id && darkMode}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1 pr-0">
                                <h6>{{team.place}}</h6>
                            </div>
                            <div class="col-4">
                                <div class="mx-auto" style="width: 100%;">
                                    <h5>{{team.name}}</h5>
                                </div>
                            </div>
                            <div class="col-7">
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
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {

            }
        },
        mounted() {
            // this.sortLeaderBoard();
        },
        computed: {
            ...mapGetters('team', ['teams', 'team', 'leaderBoard']),
            ...mapGetters('user', ['darkMode']),

            loggedTeam: {
                get() {
                    return this.team;
                }
            }
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
          }
        },

        watch: {
            teams: function() {
                this.sortLeaderBoard();
            }

        },
    }
</script>

<style scoped>

</style>
