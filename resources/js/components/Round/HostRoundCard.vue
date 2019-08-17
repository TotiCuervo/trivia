<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div v-if="this.round.title">
                            <h4>Round {{this.round.order_number}}: {{this.round.title}}</h4>
                        </div>
                        <div v-else>
                            <h4>Round {{this.round.order_number}}</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>{{round.time}} seconds per question</h3>
                    </div>
                </div>
                <div class="row">
                    <div v-for="question in questions">
                        <div class="col-md-12" v-if="question.round_id === round.id">
                            <small>{{question.order_number}}. {{question.title}}</small>
                        </div>
                    </div>
                </div>
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
        methods: {

        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions'])
        },
        props: ['round']
    }
</script>

<style scoped>

</style>