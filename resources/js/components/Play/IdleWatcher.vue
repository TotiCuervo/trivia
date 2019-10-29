<template>
    <b-modal id="idleWarning" title="Idle" size="lg" hide-footer>
        <p>
            Hello World
        </p>
    </b-modal>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                messageStr: 'Hello',
                counter: 0,
                countTime: false,
            }
        },
        onIdle() {
            console.log('now idle');
        },
        onActive() {
            console.log(this.team.gameCode);
            axios.post('/api/play/game/'+this.team.id+'/whereAreWe')
                .then(response => {
                console.log('made it to whereAreWe');
            });

        },
        methods: {
            countIdle() {
                this.counter++;
            }
        },
        computed: {
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            ...mapGetters('team', ['team']),


        }
    }
</script>

<style scoped>

</style>
