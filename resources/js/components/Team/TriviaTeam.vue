<template>
    <div>
        <div class="card fancy-2">
            <div class="card-body">
                <h5>{{team.name}}</h5>
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
        props: ['team']
    }
</script>

<style scoped>

</style>