<template>
    <div>
        <div v-if="!(this.trivia_id == null)">
            <div class="trivia-intro">
                <div class="row">
                    <div class="col-md-12">
                        <div class="game-header">
                            <div class="float-right">
                                <button type="button" class="btn"><i class="far fa-edit fa-2x"></i></button>
                            </div>
                            <div v-if="trivia.name">
                                <h1>{{ trivia.name }}</h1>
                            </div>
                            <div v-else>
                                <h1>Uh oh!</h1>
                            </div>
                            <div v-if="trivia.description">
                                <h3 class="text-muted">
                                    {{ trivia.description }}
                                </h3>
                            </div>
                            <div v-else>
                                <h3 class="text-muted">
                                    Edit to add Description
                                </h3>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="trivia-outline">
                <RoundIndex></RoundIndex>
            </div>

            <div class="add-trivia">
                <AddTrivia></AddTrivia>
            </div>
        </div>
    </div>
</template>

<script>

    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                // trivia: null,
                id: null,
            }
        },
        mounted() {

            this.id = this.$route.params;

            this.fetchData(this.id);
        },
        methods:{
            ...mapActions('game', ['fetchData']),
        },
        computed: {
            ...mapGetters('game', ['trivia', 'trivia_id']),
            ...mapGetters('round', ['rounds']),
        }
    }
</script>

<style scoped>

</style>