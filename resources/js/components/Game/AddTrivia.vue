<template>
    <div>
        <div class="row">
            <!--<div class="col-md-6">-->
                <!--<router-link :to="{ name: 'roundForm' }" class="round-button"><button type="button" class="btn btn-success w-100 min-vh-50">Add Round</button></router-link>-->
            <!--</div>-->
            <!--<div class="col-md-6">-->
                <!--<button type="button" class="btn btn-danger w-100 min-vh-50">Add a Break</button>-->
            <!--</div>-->

            <div class="col-md-6">
                <button type="button" class="btn btn-success w-100 min-vh-50" @click="newRound">Add Round</button>
            </div>
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
        methods:{
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('round', ['addRound']),

            newRound()
            {
                this.id = this.$route.params;
                this.addRound();
                console.log('made it');
                // this.$router.push({ name: "showGame", params: { id: this.id.id }});
            }
        },
        computed: {
            ...mapGetters('round', ['roundCount', 'formTitle', 'formGameID', 'formOrderNumber', 'formRoundType']),
            ...mapGetters('game', ['trivia', 'trivia_id']),
        }
    }
</script>

<style scoped>

</style>