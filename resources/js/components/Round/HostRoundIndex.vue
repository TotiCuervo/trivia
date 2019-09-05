<template>
    <div>
        <div v-for="(round, index) in rounds">
            <div class="row">
                <div class="col-md-12">
                    <h3><b>Round: {{round.order_number}}</b></h3>
                    <HostQuestionIndex :round="round"></HostQuestionIndex>
                    <hr v-if="index !== rounds.length - 1">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        props: ['rounds'],
    }
</script>

<style scoped>

</style>