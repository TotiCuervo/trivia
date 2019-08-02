<template>
    <div>
        <h1>I am the lobby</h1>
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
            axios.get('/api/team/user')
                .then(response => {
                    console.log(response.data);
                    console.log('Made it');

                });
        },
        methods: {
            ...mapActions('user', ['fetchData']),
            logout(){
                axios.post('/logout')
                    .then(() => {
                        window.location = window.location.protocol + "/login";
                    });
            },
        },
        computed: {
            ...mapGetters('user', ['user']),
        },
    }
</script>

<style scoped>

</style>