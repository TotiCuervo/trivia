<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Enter Name" v-model="title">
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <select class="form-control">
                        <option value=0>No Time Limit</option>
                        <option value="10" selected="selected">10 Sec</option>
                        <option value="20">20 Sec</option>
                        <option value="30">30 Sec</option>
                    </select>
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

            }
        },
        mounted() {
            // this.id = this.$route.params;
            // // this.fetchRounds(this.id);
            this.game_id = this.trivia_id;
            this.round_type = 'play';
        },
        methods:{

        },
        computed: {
            ...mapGetters('game', ['trivia_id']),
            ...mapGetters('round', ['roundCount', 'formTitle', 'formGameID', 'formOrderNumber', 'formRoundType']),

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
                    return this.formOrderNumber;
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