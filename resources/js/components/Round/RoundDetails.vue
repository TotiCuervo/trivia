<template>

    <div>

        <div class="round-details">
            <div class="row pb-3">
                <div class="col-md-12">
                    <h4 class="float-left">Round: {{this.round.order_number}}</h4>
                    <div class="float-right">
                        <p>xxx</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="question-index">

            <QuestionIndex :round_id="this.round.id"></QuestionIndex>

        </div>
        <div class="add-question">
            <div class="row pt-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success">
                        <div v-if="this.id">
                            <router-link :to="{ name: 'createQaForm', params: { id: id.id, round_id: this.round.id } }" class="nav-link"><span style="color:white">Add Question</span></router-link>
                        </div>
                    </button>
                    <hr>
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
                id: '',
            }
        },
        mounted() {
            this.id = this.$route.params;
        },
        props: ['round']
    }
</script>

<style scoped>

</style>