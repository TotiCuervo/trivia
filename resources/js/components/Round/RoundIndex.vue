<template>
    <div>

        <div v-if="this.rounds.length === 0">
            <div class="row pb-4">
                <div class="col-md-12">
                   Add a round now!
                </div>
            </div>
        </div>
        <div v-else>
            <div v-for="round in this.rounds">
                <div class="row pb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h1>Round {{ round.order_number }}</h1>
                                <h3 v-if="round.title"> {{round.title}}</h3>
                            </div>
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
        mounted() {

        },
        methods:{

        },
        computed: {
            ...mapGetters('round', ['rounds']),
        }
    }
</script>

<style scoped>

</style>