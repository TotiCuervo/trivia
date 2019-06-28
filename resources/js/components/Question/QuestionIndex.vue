<template>
    <div>
        <div v-for="question in questions">
            <!--<h5>{{round_id}}</h5>-->
            <div v-if="question.round_id === round_id">
                <h5>{{question.title}}</h5>
            </div>
        </div>
    </div>
    
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                id: null,
            }
        },
        mounted() {
            this.id = this.$route.params;
            // this.fetchQuestions(this.id.id);
        },
        methods:{
            ...mapActions('question', ['fetchQuestions']),
        },
        computed: {
            ...mapGetters('question', ['questions']),
        },
        props: ['round_id'],
    }
</script>

<style scoped>

</style>