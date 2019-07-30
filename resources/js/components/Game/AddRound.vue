<template>


    <div class="pt-2 pb-5">
        <div class="row no-gutters">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <b-button pill class="w-100 h-100 pt-4 pb-4" variant="outline-dark" @click="newRound">
                            Add Round
                        </b-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="pt-2 pb-5">-->
        <!--<div class="row no-gutters">-->
            <!--<div class="col-md-10 offset-md-1">-->
                <!--<div class="row">-->
                    <!--<div class="col-md-4 offset-md-2">-->
                        <!--<b-button pill class="w-100 h-100 pt-4 pb-4" variant="outline-dark" @click="newRound">-->
                            <!--Add Round-->
                        <!--</b-button>-->
                    <!--</div>-->
                    <!--<div class="col-md-4">-->
                        <!--<b-button pill class="w-100 h-100 pt-4 pb-4" variant="outline-dark" @click="newBreak">Add Break</b-button>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->

</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                id: null,
                showByIndex: null,
            }
        },
        mounted() {
            this.id = this.$route.params;
            this.round_game_id = this.game_id;
        },
        methods:{
            ...mapActions('round', ['fetchRounds','addRound', 'addBreak']),
            //adds new round to game
            newRound()
            {
                //triggers new round function in round store
                this.addRound();
            },
            newBreak()
            {
                this.addBreak();
            }
        },
        computed: {
            ...mapGetters('round', ['formGameID']),
            ...mapGetters('game', ['game', 'game_id']),
            round_game_id: {
                get (){
                    return this.formGameID;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_GAME_ID', value);
                }
            },
        }
    }
</script>

<style scoped>

</style>