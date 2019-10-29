<template>
    <div v-if="this.game_code">

        <!--Not Visible-->
        <HostModals></HostModals>
        <HostPresenceChannel></HostPresenceChannel>

        <!--Visible-->
        <HostHeader></HostHeader>
        <HostPageNav></HostPageNav>

    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                params: '',
            }
        },
        mounted() {
            document.querySelector('body').className = 'host-background';

            //Gets the parameters from the route
            this.params = this.$route.params;

            //fetches the game information
            this.fetchData(this.params);

            //fetches the round information
            this.fetchRounds(this.params);

            //fetches the question information
            this.fetchQuestions(this.params.id);

            //fetches the answer information
            this.fetchAnswers(this.params.id);

            //Prompts user before closing
            if (!localStorage.getItem('gameCode')) {
                this.createFreshGameCode(this.params);
            } else {
                this.game_code = JSON.parse(localStorage.getItem('gameCode'));
            }

            this.currentPage = 'HostLobby';

            window.onbeforeunload = function(e) {
                return 'Are you sure you want to leave? You will lose all game data';
            };
        },
        methods: {
            ...mapActions('game', ['fetchData', 'createFreshGameCode']),
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('question', ['fetchQuestions']),
            ...mapActions('answer', ['fetchAnswers']),
        },
        computed: {
            ...mapGetters('game', ['game', 'game_id', 'gameCode']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            game_code: {
                get() {
                    return this.gameCode;
                },
                set(value) {
                    return this.$store.commit('game/SET_GAME_CODE', value);
                }
            },
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            }

        }

    }
</script>

<style scoped>

</style>
