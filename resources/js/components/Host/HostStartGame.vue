<template>
    <div>
        <div class="row pb-4">
            <div class="col-md-12">
                <div class="float-left">
                    <b-button pill variant="outline-primary" @click='goToHostLobby()' v-if="currentPage === 'HostStartGame'">Back</b-button>
                </div>
                <div class="float-right">
                    <b-button pill variant="primary" @click="startRound()">Start Round {{this.rounds[this.roundPosition].order_number}}</b-button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-12 text-center pb-3">
                <h3>Select round:</h3>
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
            startThisRound(index) {
                this.playRoundPosition = index;
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
