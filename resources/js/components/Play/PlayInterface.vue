<template>
    <div>
        <PlayPresenceChannel></PlayPresenceChannel>
        <TeamPlayHeader></TeamPlayHeader>
        <PlayPageNav></PlayPageNav>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                revealAnswer: false
            }
        },
        mounted() {
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
                axios.post('/api/team/logout/'+ this.loggedTeam.id);
            },
        },
        computed: {
            ...mapGetters('team', ['team', 'teamAnswers']),
            loggedTeam: {
                get() {
                    return this.team;
                },
                set(value) {
                    return this.$store.commit('team/SET_TEAM', value);
                }
            },
        }
    }
</script>

<style scoped>

</style>
