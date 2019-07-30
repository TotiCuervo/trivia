<template>
    <div class="pr-3 pl-3" v-if="this.gameCode.code !== ''">
        <div class="row" v-bind:class="this.game.headClass">
            <div class="col-md-12">
                <HostGameHeader></HostGameHeader>
            </div>
            <div class="col-md-12 text-center" style="color:white;">
                <h3>This Trivia game can be joined using this code: <u><b>{{this.gameCode.code}}</b></u></h3>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-6 text-center">
                <h1>Incoming players</h1>
            </div>
            <div class="col-md-6 vl">
                <h1 class="text-center pb-3">Game outline</h1>
                <HostGameOutline></HostGameOutline>
            </div>
        </div>
        <!--<div class="row">-->
            <!--<div class="col-md-8 offset-md-2">-->
                <!--<b-button block pill variant="success">Let's Play!</b-button>-->
            <!--</div>-->
        <!--</div>-->
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                params: '',
                gameCode: {
                    code: '',
                    expirationTime: ''
                },
            }
        },
        mounted() {
            this.params = this.$route.params;
            this.fetchData(this.params);

            //get the game code
            axios.get('/api/game/' + this.params.id + '/gameCode', {
            })
                .then(response => {

                    if (response.data === false) {

                        axios.post('/api/gameCode/' + this.params.id + '/create', {
                        })
                            .then(response => {
                                this.gameCode = response.data;
                            })
                            .catch(error => {
                                console.log(error);
                            });

                    } else {
                        // console.log(response.data);
                        this.gameCode = response.data[0];
                    }


                })
                .catch(error => {
                    console.log(error);
                });
        },
        beforeDestroy() {

            //changes the value to false
            axios.post('/api/game/' + this.game.id + '/gameOver', {
                _method: 'patch'
            })
                .then(response => {
                    // console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
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