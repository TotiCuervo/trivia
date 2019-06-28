<template>
    <div>
        <div class="round-intro">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right">
                        <button type="button" class="btn btn-success" @click="newRound" ><h4 class="mb-0">Save</h4></button>
                    </div>
                    <h1>Round {{roundCount + 1}}</h1>
                    <hr>
                </div>
            </div>
        </div>

        <div class="create-round">
            <CreateRound></CreateRound>
        </div>

        <div class="QA-Form">
            <QAForm></QAForm>
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
        mounted(){
            this.id = this.$route.params;
            this.fetchRounds(this.id);
        },
        methods:{
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('round', ['addRound']),

            newRound()
            {
                this.addRound();
                this.fetchRounds(this.id);
                this.$router.push({ name: "showGame", params: { id: this.id.id }});
            }
        },
        computed: {
            ...mapGetters('round', ['roundCount', 'formTitle', 'formGameID', 'formOrderNumber', 'formRoundType']),
        }
    }
</script>


<style scoped>

</style>