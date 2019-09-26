<template>
    <div v-if="this.round">
<!--        <div class="fancy3 card clicker" v-bind:class="{isChosen: this.round.order_number === this.rounds[this.roundPosition].order_number}">-->
<!--            <div class="card-body">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12 text-center">-->
<!--                        <div v-if="this.round.title">-->
<!--                            <h4>Round {{this.round.order_number}}: {{this.round.title}}</h4>-->
<!--                        </div>-->
<!--                        <div v-else>-->
<!--                            <h4>Round {{this.round.order_number}}</h4>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12 text-center">-->
<!--                        <h3>{{round.time}} seconds per question</h3>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div v-for="question in questions">-->
<!--                        <div class="col-md-12" v-if="question.round_id === round.id">-->
<!--                            <small>{{question.order_number}}. {{question.title}}</small>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="trivalo-card card clicker">
            <div class="card-header" v-bind:class="{isChosen: this.round.order_number === this.rounds[this.roundPosition].order_number}">
                <div class="row">
                    <div class="col-12 text-center">
                        <h5 class="m-0 font-weight-normal">Round {{this.round.order_number}}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <h6 class="m-0 pb-2" v-if="this.round.title">{{this.round.title}}</h6>
                        <h6 class="m-0 pb-2" v-else> No Description</h6>

                        <h6 class="m-0 pb-2">{{this.questions.filter(x => x.round_id === this.round.id).length}} Questions</h6>

                        <h6 class="m-0" v-if="this.round.time">{{this.round.time}}s each</h6>
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
