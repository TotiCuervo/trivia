<template>
    <div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="name"
                   placeholder="Enter Name" v-model="name">
        </div>
        <div class="form-group">
            <label>Description (Optional)</label>
            <input type="text" class="form-control" id="description" aria-describedby="name"
                   placeholder="Enter Name" v-model="description">
        </div>
        <div class="form-group">
            <label>Company (Optional)</label>
            <input type="text" class="form-control" id="company" aria-describedby="name"
                   placeholder="Enter Name" v-model="company">
        </div>
        <button @click="newGame()" class="btn btn-primary">Submit</button>
    </div>

</template>

<script>
    import axios from 'axios';
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                name: null,
                description: null,
                company: null,
            }
        },
        mounted() {

        },
        methods: {
            newGame(){
                axios.post('/api/game/create',{
                    name: this.name,
                    description: this.description,
                    company: this.company,
                    user_id: this.user_id,
                }).then(response => {
                    let game = response.data;
                    // this.createGameOrder(game.id);
                    this.$router.push({ name: "gameDetails", params: { id: game.id }});

                });
            },
        },
        computed: {
            ...mapGetters('user', ['user_id']),
        },
    }
</script>

<style scoped>

</style>