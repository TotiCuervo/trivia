<template>
    <div>
        <!--SubHeader-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">

                    <!--left-->
                    <h6 class="mb-0 flex-grow-1">Game Over</h6>

                    <!--right-->
                    <b-button pill variant="primary" class="float-right" @click="goToGameLobby()">Game Lobby</b-button>
                </div>
            </div>
        </div>
        <!--Top 3-->
        <div class="row pt-3 justify-content-center">
            <div class="col-12 col-sm-4 col-md-3 text-center">
                <div class="row">
                    <div class="col-12">
                        <div class="fa-10x color-gold">
                            <span class="fa-layers fa-fw">
                                <i class="fas fa-award"></i>
                                <span class="fa-layers-text fa-inverse color-gold" data-fa-transform="shrink-13 up-2.5" style="font-weight:900">1st</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>{{this.teams[0].name}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-3 text-center">
                <div class="row">
                    <div class="col-12">
                        <div class="fa-10x color-silver">
                            <span class="fa-layers fa-fw">
                                <i class="fas fa-award"></i>
                                <span class="fa-layers-text fa-inverse color-silver" data-fa-transform="shrink-13 up-2.5" style="font-weight:900">2nd</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>{{this.teams[1].name}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-3 text-center">
                <div class="row">
                    <div class="col-12">
                        <div class="fa-10x color-bronze">
                            <span class="fa-layers fa-fw">
                                <i class="fas fa-award"></i>
                                <span class="fa-layers-text fa-inverse color-bronze" data-fa-transform="shrink-13 up-2.5" style="font-weight:900">3rd</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>{{this.teams[2].name}}</h3>
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
        methods: {
            goToGameLobby() {
                this.currentPage = "HostGameLobby";
            }
        },
        computed: {
            ...mapGetters('team', ['teams']),
        }
    }
</script>

<style scoped>

</style>
