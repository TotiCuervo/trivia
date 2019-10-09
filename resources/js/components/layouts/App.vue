<template>

    <div>
        <nav class="navbar navbar-expand-md navbar-light pt-3" v-if="!(noNav.includes(this.$route.name))">
            <div class="container-fluid">

                <a class="clicker mb-0 text-decoration-none" v-bind:class="{'color-black then-black': !this.darkMode, 'color-white then-white': this.darkMode}" href="/app#/home" style="font-family: 'Pacifico', cursive;">
                    <h2>Trivalo</h2>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <ToggleDarkMode></ToggleDarkMode>

                        <a class="dropdown-item triv-nav-dropdown dropdown-blue" v-bind:class="{'darkMode': this.darkMode}" href="#">
                            <span class=""><i class="fas fa-user"></i></span>
                            My Account
                        </a>

                        <a class="dropdown-item dropdown-blue triv-nav-dropdown"v-bind:class="{'darkMode': this.darkMode}"  href="#" @click.prevent="logout">
                            <span class=""><i class="fas fa-sign-out-alt"></i></span>
                            Logout
                        </a>
                    </ul>
                </div>
            </div>
        </nav>
        <b-container fluid class="pl-0 pr-0">
            <router-view></router-view>
        </b-container>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                little_id: null,
                noNav: ['hostLobby', 'hostInterface']
            }
        },
        created() {

            this.fetchData();

        },
        methods: {
            ...mapActions('user', ['fetchData']),
            logout(){
                axios.post('/logout')
                    .then(() => {
                        window.location = window.location.protocol + "/login";
                    });
            },
        },
        computed: {
            ...mapGetters('user', ['user_id','darkMode']),
        },
    }
</script>

<style scoped>

</style>
