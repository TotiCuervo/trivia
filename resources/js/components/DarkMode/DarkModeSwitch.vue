<template>
    <div class="onoffswitch" @click="toggleDM()">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" @click="toggleDM()">
        <label class="onoffswitch-label" v-bind:class="{'darkMode': this.darkMode}" for="myonoffswitch">
                <span class="onoffswitch-inner">
                </span>
            <span class="onoffswitch-switch">
                    <span class="color-white" v-show="!darkMode">
                        <i class="fas fa-sun" style="margin-left: 1px; margin-bottom: 3px;"></i>
                    </span>
                    <span v-show="darkMode">
                        <i class="fas fa-moon" style="margin-bottom: 3px; color: #1C2532;"></i>
                    </span>
                </span>
        </label>
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
