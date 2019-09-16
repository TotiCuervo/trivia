<template>
    <div>
        <!--Navbar-->
        <!--<nav class="navbar navbar-expand-lg fixed-top" v-bind:class="{'header-shadow bg-white': showNavbar}">-->
            <!--<a class="navbar-brand" style="color:darkorange;">Trivalo</a>-->
            <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">-->
                <!--<span class="navbar-toggler-icon"></span>-->
            <!--</button>-->
            <!--<div class="collapse navbar-collapse" id="navbarText">-->
                <!--<span class="navbar-text ml-auto mr-2">-->
                    <!--Want to have an event?-->
                <!--</span>-->
                <!--<b-button pill variant="outline-danger">Plan a Trivalo Night</b-button>-->
            <!--</div>-->
        <!--</nav>-->

        <transition name="fade">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" v-if="!showNavbar">
                <a class="navbar-brand" style="color:darkorange;">Trivalo</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <span class="navbar-text ml-auto mr-2 text-white">
                        Want to have an event?
                    </span>
                    <b-button pill variant="outline-danger">Plan a Trivalo Night</b-button>
                </div>
            </nav>
        </transition>

        <transition name="fade">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top header-shadow bg-white" v-if="showNavbar || widthTooSmall">
                <a class="navbar-brand" style="color:darkorange;">Trivalo</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <span class="navbar-text ml-auto mr-2">
                        Want to have an event?
                    </span>
                    <b-button pill variant="outline-danger">Plan a Trivalo Night</b-button>
                </div>
            </nav>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showNavbar: false,
                widthTooSmall: false,
            }
        },
        mounted () {
            this.widthTooSmall = window.innerWidth <= 991;

            window.addEventListener('scroll', this.onScroll);
            window.addEventListener('resize', this.widthCheck);
        },
        methods: {
            onScroll() {
                // Get the current scroll position
                const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;

                // Because of momentum scrolling on mobiles, we shouldn't continue if it is less than zero
                if (currentScrollPosition < 0) {
                    return;
                }
                // Here we determine whether we need to show or hide the navbar
                this.showNavbar = currentScrollPosition > 100;

            },
            widthCheck() {
                const currentWidth = window.innerWidth;
                this.widthTooSmall = currentWidth <= 991;
            },
        }
    }
</script>

<style scoped>

</style>