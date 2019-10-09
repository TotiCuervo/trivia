<template>
    <div v-if="this.round">
        <div class="trivalo-card card clicker" v-bind:class="{isChosen: this.round.order_number === this.rounds[this.roundPosition].order_number}">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-2 col-3">
                        <h6 class="m-0 font-weight-normal">Round {{this.round.order_number}}</h6>
                    </div>
                    <div class="col-4 d-none d-md-block">
                        <h6 class="m-0" v-if="this.round.title">{{this.round.title}}</h6>
                        <h6 class="m-0" v-else>No Description</h6>
                    </div>
                    <div class="col-md-3 col-4">
                        <h6 class="m-0">{{this.questions.filter(x => x.round_id === this.round.id).length}} Questions</h6>
                    </div>
                    <div class="col-md-3 col-5">
                        <h6 class="m-0" v-if="this.round.time">{{this.round.time}} seconds each</h6>
                        <h6 class="m-0" v-else>No Time Limit</h6>
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
            ...mapGetters('question', ['questions']),
        },
        props: ['round', 'roundPosition']
    }
</script>

<style scoped>

</style>
