<template>
    <div>
        <div class="row pb-3">
            <div class="col-md-12">
                <div class="float-left">
                    <button type="button" class="btn btn-success btn-orange btn-lg mr-2" @click='goToHostLobby()' v-if="currentPage === 'HostStartGame'">Back</button>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-success btn-lg" @click="startRound()">Start Round 1</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" v-for="(round, index) in this.rounds" @click="startThisRound(index)">
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