<template>
    <div>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <!--<router-link :to="{ name: 'home' }" class="nav-link"><span style="color:white">Create Trivia Game!</span></router-link>-->
                <a class="navbar-brand" href="/">
                    Trivia
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto ml-auto">
                        <li>
                            <button type="button" class="btn btn-success">
                                <router-link :to="{ name: 'createGameName' }" class="nav-link"><span style="color:white">Create Trivia Game!</span></router-link>
                            </button>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#" @click.prevent="logout">
                                   Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--<div class="container-fluid pr-0 pl-0">-->
            <!--<router-view></router-view>-->
        <!--</div>-->
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
                hello: "Hello!",
                little_id: null,
            }
        },
        // beforeCreate() {
        //     this.fetchData();
        // },
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
            ...mapGetters('user', ['user_id']),
        },
    }
</script>

<style scoped>

</style>