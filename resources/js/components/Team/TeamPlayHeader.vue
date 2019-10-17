<template>
    <div class="row no-gutters clicker" v-bind:class="{'darkMode-card': darkMode}" style="color:white; background-color:black" @dblclick="toggleDM()">
        <div class="container">
            <div class="col-md-12 text-center">
                <h1>{{this.loggedTeam.name}}</h1>
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
        methods: {
            ...mapActions('user', ['toggleDarkMode']),
            toggleDM() {
                this.toggleDarkMode();
                document.querySelector('body').className = (this.darkMode) ? 'trivalo-darkMode' : 'host-background';
            }
        },
        computed: {
            ...mapGetters('team', ['team']),
            ...mapGetters('user', ['darkMode']),
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
