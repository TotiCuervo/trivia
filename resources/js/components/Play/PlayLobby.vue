<template>
    <div>
        <TeamPlayHeader></TeamPlayHeader>
        <PlayHomeScreen v-if="this.game.name !== ''"></PlayHomeScreen>
        <!--<div class="btn btn-primary" @click="logout()">Logout</div>-->
        <!--<div class="btn btn-primary" @click="leaving()">Logout2</div>-->

    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        name: 'Play-Lobby',
        data() {
            return {

            }
        },
        mounted() {

            this.fetchDataByGameCode(this.team.gameCode);

            Echo.join('game.'+this.loggedTeam.gameCode)
                .here((users) => {

                })
                .listen('NewTeam', (e) => {
                    // console.log(e);
                    console.log('WOW A NEW TEAM');
                });
        },
        created() {
            window.addEventListener('beforeunload', this.leaving);
        },
        methods: {
            ...mapActions('game', ['fetchDataByGameCode']),

            logout(){
                localStorage.removeItem('user-token');
                this.$store.commit('team/CLEAR_FORM');
                this.$router.push({name: "playLogin"});
            },
            leaving() {
                axios.post('/api/team/logout/'+ this.loggedTeam.id)
                    .then(response => {

                    });
            },
        },
        computed: {
            ...mapGetters('team', ['team']),
            ...mapGetters('game', ['game']),
            loggedTeam: {
                get() {
                    return this.team;
                },
                set(value) {
                    return this.$store.commit('team/SET_TEAM', value);
                }
            }
        },
    }
</script>

<style scoped>

</style>