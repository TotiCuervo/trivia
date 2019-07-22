<template>
    <div>
       <div class="row no-gutters pt-5">
           <div class="col-md-6 offset-md-3">
               <div class="row">
                   <div class="col-md-12 text-center">
                       <h1>New Game</h1>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-12">
                       <div class="form-group">
                           <label>Name</label>
                           <input type="text" class="form-control" id="name" aria-describedby="name"
                                  placeholder="Enter Name" v-model="name">
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                           <label>Description (Optional)</label>
                           <input type="text" class="form-control" id="description" aria-describedby="name"
                                  placeholder="Enter Name" v-model="description">
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                           <label>Company (Optional)</label>
                           <input type="text" class="form-control" id="company" aria-describedby="name"
                                  placeholder="Enter Name" v-model="company">
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-12 pb-3">
                       <label>Pick Color Scheme</label>
                   </div>
                   <div class="col-md-2">
                       <i class="fas fa-circle fa-stack-2x" style="color: #D1504F;" @click="setRed()"></i>
                       <i class="far fa-circle fa-stack-2x" v-if=" this.color === 'bc-header-red' "></i>
                   </div>
                   <div class="col-md-2">
                       <i class="fas fa-circle fa-stack-2x" style="color: #4FA1D1;" @click="setBlue()"></i>
                       <i class="far fa-circle fa-stack-2x" v-if=" this.color === 'bc-header-blue' "></i>

                   </div>
                   <div class="col-md-2">
                       <i class="fas fa-circle fa-2x" style="color: #4FD17C;"></i>
                   </div>
                   <div class="col-md-2">
                       <i class="fas fa-circle fa-2x" style="color: #FFCD2B;"></i>
                   </div>
               </div>
               <div class="row pt-4">
                   <div class="col-md-12">
                       <button @click="newGame()" class="btn btn-primary">Submit</button>
                   </div>
               </div>
           </div>
       </div>
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
                color: 'bc-header-blue',
            }
        },
        mounted() {
        },
        beforeCreate() {
            this.color = 'bc-header-red';
            document.body.className = this.color;
        },
        update() {
            document.body.className = this.color;
        },
        methods: {
            ...mapActions('round', ['addRound']),
            newGame(){
                axios.post('/api/game/create',{
                    name: this.name,
                    description: this.description,
                    company: this.company,
                    user_id: this.user_id,
                }).then(response => {
                    let $game = response.data;
                    // this.createGameOrder(game.id);
                    this.$store.commit('round/UPDATE_GAME_ID', $game.id);

                    this.addRound();

                    this.$router.push({ name: "gameDetails", params: { id: $game.id }});

                });
            },
            setRed() {
                this.color = 'bc-header-red';
            },
            setBlue() {
                this.color = 'bc-header-blue';
            },
        },
        computed: {
            ...mapGetters('user', ['user_id']),

        },
    }
</script>

<style scoped>

</style>