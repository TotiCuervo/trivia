<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>New Game</h1>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <b-input v-model.trim="name" v-if="name.length <= nameCC" placeholder="Trivia Name"></b-input>
                                <b-input v-model.trim="name" :state="!(name.length > nameCC)" v-else></b-input>
                                <b-form-invalid-feedback :state="!(name.length > nameCC)" >
                                    {{nameCC - name.length}}
                                </b-form-invalid-feedback>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description (Optional)</label>
                                <b-input v-model.trim="description" v-if="description.length <= descriptionCC" placeholder="Description"></b-input>
                                <b-input v-model.trim="description" :state="!(description.length > descriptionCC)" v-else></b-input>
                                <b-form-invalid-feedback :state="!(description.length > descriptionCC)" >
                                    {{descriptionCC - description.length}}
                                </b-form-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company (Optional)</label>
                                <b-input v-model.trim="company" v-if="company.length <= companyCC" placeholder="Company Name"></b-input>
                                <b-input v-model.trim="company" :state="!(company.length > companyCC)" v-else></b-input>
                                <b-form-invalid-feedback :state="!(company.length > companyCC)" >
                                    {{companyCC - company.length}}
                                </b-form-invalid-feedback>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4 pb-4">
                        <div class="col-md-12">
                            <button @click="newGame()" v-if="validation" class="btn btn-primary float-right">Submit</button>
                            <button v-if="!validation" disabled class="btn btn-primary float-right">Submit</button>

                        </div>
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
                name: '',
                description: '',
                company: '',
                nameCC: 40,
                descriptionCC: 20,
                companyCC: 20,
            }
        },
        mounted() {

            //checks to see if nightMode is on
            if (this.darkMode) {
                document.getElementById('create-game___BV_modal_content_').className = 'darkMode-card modal-content';
            }
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
        },
        computed: {
            ...mapGetters('user', ['user_id','darkMode']),
            //For Validation
            validation() {
                return this.name.length > 0 && this.name.length <= this.nameCC && this.description.length <= this.descriptionCC && this.company.length <= this.companyCC;
            }
        },
    }
</script>

<style scoped>


</style>
