<template>
    <div>
        <div class="team-card card clicker"
             @click="setTeam()"
             v-b-modal.team>
            <div class="card-body">
                <h5 class="mb-0">{{team.name}}</h5>
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