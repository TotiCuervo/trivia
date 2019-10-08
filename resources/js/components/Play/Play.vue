<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                token: ''
            }
        },
        mounted() {

            //checks for darkMode
            // if (this.darkMode) {
            //     document.querySelector('body').style.backgroundColor = '#18191A';
            //     document.querySelector('body').style.color = '#FFFFFF';
            // }


            this.token = localStorage.getItem('user-token') || '';

            //for development
            // if (this.token) {
            //
            //     axios.post('api/team/checkIfExpired', {
            //         token: localStorage.getItem('user-token')
            //     }).then(response => {
            //
            //         if(response.data === 'expired') {
            //             localStorage.removeItem('user-token');
            //             this.$store.commit('team/CLEAR_FORM');
            //             this.$router.push({name: "playLogin"});
            //         }
            //         else {
            //             this.loggedTeam = response.data;
            //             this.$router.push({name: "playLobby"});
            //         }
            //
            //     });
            // }
            // else {
            //     this.$router.push({name: "playLogin"});
            // }

            //for production
            this.$router.push({name: "playLogin"});

        },
        computed: {
            ...mapGetters('team', ['team']),
            ...mapGetters('play', ['darkMode']),
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
