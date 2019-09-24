<template>
    <div v-if="this.game.name !== ''">
        <div class="container pt-2 pb-2">

            <div class="row">
                <div class="col-md-12">
                    <span class="h5">
                        {{game.name}}<span v-if="game.description">: {{game.description}}</span>
                        <span class="text-muted h5" v-if="game.company"><i>- {{game.company}}</i></span>
                    </span>
                    <span class="fa-1x first-gray then-black trans-1 clicker" v-b-tooltip.top title="Edit game" v-b-modal.edit-game>
                        <i class="fas fa-pen"></i>
                    </span>
                    <hr>
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
            //sets the value of id to the id of the game that was created
            this.id = this.$route.params;

            //fetches the information of the game to load it into the details
            this.fetchData(this.id);
        },
        methods: {
            ...mapActions('game', ['fetchData']),
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id']),
        }
    }
</script>

<style scoped>


</style>
