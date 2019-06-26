<template>
    <div>
        <div class="round-intro">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right">
                        <button type="button" class="btn btn-success" @click="addRound()" ><h4 class="mb-0">Save</h4></button>
                    </div>
                    <h1>Round {{roundCount + 1}}</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Enter Name" v-model="title">
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <select class="form-control" v-model="game_id">
                        <option value=0>No Time Limit</option>
                        <option value="10" selected="selected">10 Sec</option>
                        <option value="20">20 Sec</option>
                        <option value="30">30 Sec</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-4">
                <QAForm></QAForm>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                // form: {
                //     title: null,
                //     time: null,
                //     round_type: 'play',
                // }

            }
        },
        mounted() {
            this.id = this.$route.params;
            this.fetchRounds(this.id);
        },
        methods:{
            ...mapActions('round', ['fetchRounds']),
            // ...mapActions('round', ['addRound']),

            addRound()
            {
                axios.post('api/round',{
                    game_id: this.id.id,
                    order_number: this.roundCount+1,
                    title: this.form.title,
                    time: this.form.time,
                    round_type: this.form.round_type,
                }).then(response => {
                    this.$router.push({ name: "showGame", params: { id: this.id.id }});
                }).catch( error => {
                    console.log(error.response)
                });

            }
        },
        computed: {
            ...mapGetters('game', ['trivia_id']),
            ...mapGetters('round', ['roundCount', 'formTitle', 'formGameID', 'formOrderNumber', 'formRoundType']),
            ...mapGetters('round', ['formGameID']),

            title: {
                get (){
                    return this.formTitle;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_TITLE', value);
                }
            },
            game_id: {
                get (){
                    return this.formGameID;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_GAME_ID', value);
                }
            },
            order_number: {
                get (){
                    return this.formOrderID;
                },
                set (value) {
                    this.$store.commit('round/UPDATE_ORDER_NUMBER', value);
                }
            },
            round_type: {
                get (){
                    return this.formRoundType;
                },
                set (value) {
                    this.$store.commit('round/UPDATE_ROUND_TYPE', value);
                }
            },
        }
    }
</script>

<style scoped>

</style>