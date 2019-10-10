<template>
    <div>
        <!--SubHeader-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">

                    <!--left-->
                    <h6 class="mb-0 flex-grow-1">Leaderboard</h6>

                    <!--right-->
                    <b-button pill variant="primary" class="float-right" @click='onUpNext()'>{{upNext}}</b-button>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-8 offset-md-2">
                <LeaderBoardIndex></LeaderBoardIndex>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                upNext: '',
                newRoundPosition: '',
            }
        },
        mounted() {
            if (this.roundPosition === this.rounds.length - 1) {
                this.upNext = 'Game Over'
            } else {
                this.upNext = 'Start Round ' + this.rounds[this.playRoundPosition + 1].order_number;
                this.newRoundPosition = this.playRoundPosition + 1;
            }
        },
        methods: {
            onUpNext() {
                if (this.upNext === 'Game Over') {
                    this.currentPage = "HostLobby";
                    this.playRoundPosition = 0;
                    this.playQuestionPosition = 0;
                } else {
                    this.playRoundPosition = this.newRoundPosition;
                    this.playQuestionPosition = 0;
                    this.currentPage = "HostRoundPreview";
                    // this.$emit('goToDestination', this.newRoundPosition, 0, 'HostRoundPreview');
                }
            }
        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('team', ['teams']),
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
        },
    }

</script>

<style scoped>

</style>
