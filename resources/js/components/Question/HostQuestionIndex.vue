<template>
    <div>
        <div v-for="question in questions">
            <div v-if="question.round_id === round.id">
                <div class="row pb-2">
                    <div class="col-md-12">
                        <p class="mb-0"><b>Question {{question.order_number}}:</b></p>
                        <p> {{question.title}}</p>
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
        props: ['round'],
        computed: {
            ...mapGetters('question', ['questions', 'loaded']),
        }
    }
</script>

<style scoped>

</style>