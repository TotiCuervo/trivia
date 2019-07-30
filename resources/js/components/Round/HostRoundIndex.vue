<template>
    <div>
        <div v-for="round in rounds">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="pb-3 text-center"><i>Round: {{round.order_number}}</i></h5>
                    <HostQuestionIndex :round="round"></HostQuestionIndex>
                    <hr>
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