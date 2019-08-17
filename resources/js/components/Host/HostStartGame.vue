<template>
    <div>
        <div class="row pb-3">
            <div class="col-md-12">
                <button type="button" class="btn btn-success btn-lg" @click="startRound()">Start Round 1</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" v-for="round in this.rounds">
                <HostRoundCard :round="round">

                </HostRoundCard>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                currentRoundPosition: 0
            }
        },
        methods: {
            startRound() {
                this.$emit('goToDestination', this.currentRoundPosition, 0, 'HostRoundPreview');
            }

        },
        computed: {
            ...mapGetters('round', ['rounds']),
        }
    }
</script>

<style scoped>

</style>