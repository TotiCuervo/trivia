<template>
    <div class="row pt-5">
        <div class="col-12 text-center">
            <p>
                {{ messageStr }}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messageStr: 'Hello'
            }
        },
        onIdle() {
            this.messageStr = 'ZZZ'
        },
        // onActive() {
        //     this.messageStr = 'Hello'
        // }
    }
</script>

<style scoped>

</style>
