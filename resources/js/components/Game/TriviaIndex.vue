<template>
    <div>
        <div class="row pb-1" v-for="game in games">
            <div class="col-md-12">
                <router-link :to="{ name: 'showGame', params: {id: game.id} }" class="nav-link">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{game.name}}</h1>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                games: [],
                id: null,
            }
        },
        created() {


            // console.log(this.user_id);

            axios.get('api/games/'+this.user_id).
                then(response => {
                    this.games = response.data
            });
        },
        methods: {
            ...mapActions('user', ['fetchData']),
        },
        computed: {
            ...mapGetters('user', ['user_id']),
        },
    }
</script>

<style>


</style>