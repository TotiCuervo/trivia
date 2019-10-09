<template>
    <div>
        <a class="dropdown-item dropdown-blue triv-nav-dropdown clicker" @click="toggleDM()">
        <span class="" v-show="!darkMode">
            <i class="fas fa-sun"></i>
        Light
        </span>
            <span class="" v-show="darkMode">
            <i class="fas fa-moon"></i>
            Dark
        </span>
        </a>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {

            }
        },
        methods: {
            ...mapActions('user', ['toggleDarkMode']),
            toggleDM() {
                this.toggleDarkMode();

                document.querySelector('body').className = (this.darkMode) ? 'trivalo-darkMode' : 'trivalo-background';

            }

        },
        computed: {
            ...mapGetters('user', ['darkMode']),
        },

    }
</script>

<style scoped>

</style>
