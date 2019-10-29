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
            console.log('in idle');
            axios.post('/api/play/game/'+this.team.id+'/whereAreWe')
                .then(response => {
                    console.log('made it to whereAreWe inside onIdle');
                });
        },
        onActive() {
            console.log('in onActive');
            axios.post('/api/play/game/'+this.team.id+'/whereAreWe')
                .then(response => {
                console.log('made it to whereAreWe inside onActive');
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
