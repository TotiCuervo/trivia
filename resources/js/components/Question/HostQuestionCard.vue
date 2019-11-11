<template>
    <div class="hostQuestion-card card">
        <div class="card-body">
            <div class="row p-5">
                <div class="col-md-12 text-center">
                    <h4 class="m-0">{{this.questions[this.questionPosition].title}}</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {}
        },
        mounted() {

        },
        computed: {
            ...mapGetters('question', ['questions']),
            ...mapGetters('host', ['questionPosition']),
        },
    }
</script>

<style scoped>

</style>
