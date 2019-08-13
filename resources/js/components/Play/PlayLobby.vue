<template>
    <div>
        <h1>I am the lobby</h1>
        <div class="btn btn-primary" @click="logout()">Logout</div>
        <div class="btn btn-primary" @click="leaving()">Logout2</div>

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

            if (this.team.name === '') {
                axios.post('api/team', {
                    token: localStorage.getItem('user-token')
                }).then(response => {
                    this.loggedTeam = response.data;
                });
            }

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
            logout(){
                localStorage.removeItem('user-token');
                this.$store.commit('team/CLEAR_FORM');
                this.$router.push({name: "playLogin"});
            },
            leaving() {
                event.preventDefault();
                axios.post('/api/team/logout/'+ this.loggedTeam.id)
                    .then(response => {

                    });
            },
        },
        computed: {
            ...mapGetters('team', ['team']),
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