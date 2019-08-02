<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                validCode: '',
                gameCode: '',
                name: '',
                password: ''
            }
        },
        mounted() {
            this.$router.push({name: "playLogin"});
        }
    }
</script>

<style scoped>

</style>