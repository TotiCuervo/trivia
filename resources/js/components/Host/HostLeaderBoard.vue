<template>
    <div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="float-right">
                    <button type="button" class="btn btn-success btn-lg mr-2" @click='onUpNext()'>{{this.upNext}}</button>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12 text-center">
                <h3>Leaderboard:</h3>
            </div>
        </div>
        <div class="row">
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
            axios.post('/api/team/'+ this.gameCode.code +'/leaderBoard')
                .then (response => {
                    // console.log(response.data);
                    // this.$store.commit('team/SET_TEAMS', response.data);
                });


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