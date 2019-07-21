<template>
    <div class="game-creator-background pt-2 pb-5">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 offset-md-2">
                        <b-button pill class="w-100 h-100 pt-4 pb-4" variant="outline-dark"@click="newRound">
                            Add Round
                        </b-button>
                    </div>
                    <div class="col-md-4">
                        <b-button pill class="w-100 h-100 pt-4 pb-4" variant="outline-dark">Add Break</b-button>
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
                id: null,
            }
        },
        mounted() {

        },
        methods:{
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('round', ['addRound']),

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
    }
</script>

<style scoped>

</style>