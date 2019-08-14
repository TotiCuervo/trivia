<template>
    <div class="row" style="color:white; background-color:black">
        <div class="col-md-12 text-center">
            <h1>{{this.loggedTeam.name}}</h1>
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