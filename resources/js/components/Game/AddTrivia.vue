<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <router-link :to="{ name: 'roundForm' }" class="round-button"><button type="button" class="btn btn-success w-100 min-vh-50">Add Round</button></router-link>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-danger w-100 min-vh-50">Add a Break</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "add-trivia"
    }
</script>

<style scoped>

</style>