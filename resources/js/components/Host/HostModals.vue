<template>
    <div>
        <!--Modals-->
        <b-modal id="leaderBoard" title="Leaderboard" size="lg" hide-footer>
            <LeaderBoardIndex></LeaderBoardIndex>
        </b-modal>
        <b-modal id="gameOutline" title="Game Outline" size="lg" hide-footer>
            <HostGameOutline></HostGameOutline>
        </b-modal>
        <b-modal id="teamList" title="Team List" size="lg" hide-footer>
            <GameTeamIndex :col="8"></GameTeamIndex>
        </b-modal>
        <b-modal id="team" title="Team Profile" size="lg" hide-footer>
            <HostTeamProfile></HostTeamProfile>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "HostModals"
    }
</script>

<style scoped>

</style>
