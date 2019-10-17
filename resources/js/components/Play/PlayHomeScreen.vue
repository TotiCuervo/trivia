<template>
    <div>
        <div class="row pt-4">
            <div class="col-md-12 text-center">
                <h3>{{this.game.name}} Trivia</h3>
            </div>
        </div>
        <div class="row pt-2" v-if="this.game.company">
            <div class="col-md-12 text-center">
                <h5><i>{{this.game.company}}</i></h5>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12 text-center">
                <h5>This game will begin shortly</h5>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12 text-center">
                <h5>Want to play in Dark Mode? Tap your team name to activate Dark Mode!</h5>
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
        computed: {
            ...mapGetters('game', ['game']),

        }
    }
</script>

<style scoped>

</style>
