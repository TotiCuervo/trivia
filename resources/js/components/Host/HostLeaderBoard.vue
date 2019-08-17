<template>
    <div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Leaderboard:</h3>
                <div class="float-right">
                    <button type="button" class="btn btn-success btn-lg mr-2" @click='onUpNext()'>{{this.upNext}}</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>This is the Leaderboard. stay tuned for more</h1>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                upNext: '',
                newRoundPosition: '',
            }
        },
        mounted() {
            if (this.roundPosition === this.rounds.length - 1) {
                this.upNext = 'Game Over'
            } else {
                this.upNext = 'Start Round ' + this.rounds[this.roundPosition + 1].order_number;
                this.newRoundPosition = this.roundPosition + 1;
            }
        },
        methods: {
            onUpNext() {
                if (this.upNext === 'Game Over') {
                    this.$emit('gameOver');
                } else {
                    this.$emit('goToDestination', this.newRoundPosition, 0, 'HostRoundPreview');
                }
            }
        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('round', ['rounds'])
        },
        props: ['roundPosition']
    }
</script>

<style scoped>

</style>