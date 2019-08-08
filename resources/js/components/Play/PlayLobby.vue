<template>
    <div>
        <h1>I am the lobby</h1>
        <div class="btn btn-primary" @click="logout()">Logout</div>
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
                    // console.log(response.data);
                    this.loggedTeam = response.data;
                });
            }

            console.log(localStorage.getItem('poop'));
        },
        methods: {
            logout(){
                localStorage.removeItem('user-token');
                this.$store.commit('team/CLEAR_FORM');
                this.$router.push({name: "playLogin"});
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