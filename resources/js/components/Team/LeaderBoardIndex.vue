<template>
    <div>
        <div class="row pb-3" v-for="team in this.leaderBoard">
            <div class="col-md-12">
                <div class="trivalo-card card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1 pr-0">
                                <table style="height: 100%;">
                                    <tbody>
                                    <tr>
                                        <td class="h6">{{team.place}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <table style="height: 100%;">
                                    <tbody>
                                    <tr>
                                        <td class="mb-0 h5"><HostTeamName :team="team"></HostTeamName></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <div class="size-2x5">
                                    <span class="fa-layers fa-fw clicker text-really-muted" v-if="!team.double" v-b-tooltip.top title="Still available">
                                        <i class="fas fa-certificate"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                              style="font-weight:900">2X</span>
                                    </span>
                                    <span class="fa-layers fa-fw clicker" v-else v-b-tooltip.top title="2X used">
                                        <i class="fas fa-certificate"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                              style="font-weight:900">2X</span>
                                    </span>

                                    <span class="fa-layers fa-fw clicker text-really-muted" v-if="!team.triple" v-b-tooltip.top title="Still available">
                                        <i class="fas fa-certificate"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                              style="font-weight:900">3X</span>
                                    </span>
                                    <span class="fa-layers fa-fw clicker" v-else v-b-tooltip.top title="3X used">
                                        <i class="fas fa-certificate"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5"
                                              style="font-weight:900">3X</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-3">
                                <table class="float-right" style="height: 100%;">
                                    <tbody>
                                    <tr>
                                        <td class="mb-0 h6">{{team.points}} Points</td>
                                    </tr>
                                    </tbody>
                                </table>
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
            axios.post('/api/team/'+ this.gameCode.code +'/leaderBoard')
                .then (response => {
                    console.log('Updated Teams:');
                    console.log(response.data);
                    this.$store.commit('team/SET_TEAMS', response.data);
                });
            this.sortLeaderBoard();
        },
        methods: {
            ...mapActions('team', ['sortLeaderBoard'])
        },
        computed: {
            ...mapGetters('team', ['teams', 'leaderBoard']),
            ...mapGetters('game', ['gameCode']),

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
