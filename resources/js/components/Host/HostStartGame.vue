<template>
    <div>
        <!--SubHeader-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">

                    <!--left-->
                    <div class="flex-grow-1">
                        <b-button pill class="float-left" variant="outline-primary" @click='goToHostLobby()' v-if="currentPage === 'HostStartGame'">Back</b-button>
                    </div>

                    <h5 class="m-0 flex-grow-1">Select Round</h5>

                    <!--right-->
                    <b-button pill class="float-right" variant="primary" @click="startRound()">Start Round {{this.rounds[this.roundPosition].order_number}}</b-button>

                </div>
            </div>
        </div>
        <!--Content-->
        <div class="row justify-content-center pt-5">
            <div class="col-md-10 text-center pb-3">
                <div class="row">
                    <div class="col-md-2 col-3">
                        <small class="m-0 pl-4 font-weight-bold">Round #</small>
                    </div>
                    <div class="col-4 d-none d-md-block">
                        <small class="m-0 pl-3 font-weight-bold">Description</small>
                    </div>
                    <div class="col-md-3 col-4">
                        <small class="m-0 pr-3 font-weight-bold"># of Questions</small>
                    </div>
                    <div class="col-md-3 col-5">
                        <small class="m-0 pr-5 font-weight-bold">Time Limit</small>
                    </div>
                </div>
                <hr class="mt-0">
            </div>
            <div class="col-md-10 pb-4" v-for="(round, index) in this.rounds" @click="startThisRound(index)">
                <HostRoundCard :round="round" :roundPosition="playRoundPosition"></HostRoundCard>
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

        },
        methods: {
            startRound() {
                this.currentPage = 'HostRoundPreview';
            },
            startThisRound(roundPosition) {
                this.playRoundPosition = roundPosition;
            },
            goToHostLobby() {
                this.currentPage = 'HostLobby';
            },

        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            playRoundPosition: {
                get() {
                    return this.roundPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_ROUND_POSITION', value);
                }
            },
            playQuestionPosition: {
                get() {
                    return this.questionPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_QUESTION_POSITION', value);
                }
            },
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            }
        }
    }
</script>

<style scoped>

</style>
