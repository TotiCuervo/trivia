<template>
    <div>
        <div v-if="team.loggedIn">{{team.name}}</div>
        <div v-else>{{team.name}}
            <span v-b-tooltip.top title="Not Logged In">
                <i class="fa-1x fas fa-ghost text-muted clicker"></i>
            </span>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {

            }
        },
        methods: {

        },
        props: ['team']
    }
</script>

<style scoped>

</style>