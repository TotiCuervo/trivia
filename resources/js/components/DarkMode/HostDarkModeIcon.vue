<template>
    <div>
        <span v-show="!this.darkMode" class="fa-stack fa-1 first-white then-black clicker float-right pr-2" style="vertical-align: top;" @click="toggleDM()">
            <i class="far fa-circle fa-stack-2x"></i>
            <i class="fas fa-sun fa-stack-1x"></i>
        </span>
        <span v-show="this.darkMode" class="fa-stack fa-1 first-white then-black clicker float-right pr-2" style="vertical-align: top;" @click="toggleDM()">
            <i class="far fa-circle fa-stack-2x"></i>
            <i class="fas fa-moon fa-stack-1x"></i>
        </span>
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
                document.querySelector('body').className = (this.darkMode) ? 'trivalo-darkMode' : 'host-background';
            }
        },
        computed: {
            ...mapGetters('user', ['darkMode']),
        },

    }
</script>

<style scoped>

</style>
