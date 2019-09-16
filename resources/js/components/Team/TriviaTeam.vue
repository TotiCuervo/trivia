<template>
    <div>
        <div class="team-card card clicker" @click="setTeam()" v-b-modal.team>
            <div class="card-body">
                <span class="mb-0 h5">
                    <HostTeamName :team="this.team"></HostTeamName>
                </span>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {

            }
        },
        methods: {
            setTeam() {
                this.$store.commit('team/SET_TEAM', this.team);
            }
        },
        props: ['team']
    }
</script>

<style scoped>

</style>