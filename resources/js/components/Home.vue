<template>
    <div>
        <div v-if="!(this.user_id == null)">
            <TriviaIndex></TriviaIndex>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                games: [],
                id: null,
            }
        },
        created() {

        },
        methods: {
            ...mapActions('user', ['fetchData']),
        },
        computed: {
            ...mapGetters('user', ['user_id']),
        },
    }
</script>

<style scoped>

</style>