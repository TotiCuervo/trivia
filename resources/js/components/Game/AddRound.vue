<template>
    <div>
        <div class="row">

            <!--adds new play round-->
            <div class="col-md-6">
                <button type="button" class="btn btn-success w-100 min-vh-50" @click="newRound">Add Round</button>
            </div>

            <!--adds new break round-->
            <div class="col-md-6">
                <button type="button" class="btn btn-danger w-100 min-vh-50">Add a Break</button>
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