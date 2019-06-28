<template>
    <div>

    </div>
</template>

<script>

    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {

            }
        },
        mounted() {
            this.fetchData(this.trivia_id);
        },
        methods:{
            ...mapActions('gameOrder', ['fetchData']),
        },
        computed: {
            ...mapGetters('gameOrder', ['gameOrder']),
            ...mapGetters('game', ['trivia_id']),

        }
    }
</script>

<style scoped>

</style>