<template>
    <div>
        <!--Beta Test Jumbotron-->
        <div class="jumbotron jumbotron-fluid vh-100 mb-0" style="background-color: rgb(252, 240, 232)">
            <div class="container cover">
                <div class="row">
                    <div class="col-md-12 text-center" style="font-family: 'Pacifico', cursive;">
                        <TrivaloLogoAnimation></TrivaloLogoAnimation>
                        <h1 class="d-md-block d-none" style="font-size:180px !important;">Trivalo</h1>
                        <h1 class="d-md-none d-sm-block d-none" style="font-size:130px !important;">Trivalo</h1>
                        <h1 class="d-sm-none d-block" style="font-size:100px !important;">Trivalo</h1>
                        <p>Beta Version 1.0</p>

                    </div>
                </div>
                <div class="row pt-2 text-white">
                    <div class="col-7 col-centered col-sm-4 offset-sm-4 text-center">
                        <b-button block pill class="triv-blue" variant="primary" size="lg" @click="goToPlay()">Let's Play</b-button></div>
                </div>
                <div style="bottom:0; position:fixed;">
                    <div class="row">
                        <div class="col-12 text-center">
                            <small>Beta Version 1.0</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--        <HomeNav></HomeNav>-->
        <!--Jumbotron 1--->
<!--        <div class="jumbotron jumbotron-fluid vh-100 babble">-->
<!--            <div class="container cover">-->
<!--                <div class="row text-white">-->
<!--                    <div class="col-md-12 text-center">-->
<!--                        <h1 style="color: darkorange">Trivalo</h1>-->
<!--                        <h4 class="pt-2">The <b> <u><i>First</i></u></b> trivia company to host games on your phone. No App Required.</h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--                &lt;!&ndash;<div class="row pt-5 text-white">&ndash;&gt;-->
<!--                    &lt;!&ndash;<div class="col-12 text-center">&ndash;&gt;-->
<!--                        &lt;!&ndash;<h5>Have a game to get to?</h5>&ndash;&gt;-->
<!--                    &lt;!&ndash;</div>&ndash;&gt;-->
<!--                &lt;!&ndash;</div>&ndash;&gt;-->
<!--                <div class="row pt-5 text-white">-->
<!--                    <div class="col-4 offset-4 text-center">-->
<!--                        <b-button block pill variant="primary" size="lg" @click="goToPlay()">Play</b-button>-->
<!--                        <small class="pt-3">or find out when our next event is</small>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        &lt;!&ndash;Main elements&ndash;&gt;-->
<!--        <div class="main">-->
<!--            <div class="container">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12 text-center">-->
<!--                        <h1>Our Upcoming Events</h1>-->
<!--                    </div>-->
<!--                    <div class="col-md-4 offset-md-4 text-center">-->
<!--                        <p class="mb-0" style="color:darkorange;">See all events</p>-->
<!--                    </div>-->
<!--                    <div class="col-md-10 offset-md-1">-->
<!--                        <hr>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row pt-4">-->
<!--                    <div class="col-12 col-md-10 offset-md-1">-->
<!--                        <div class="fancy3 card">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row pt-3 pb-3">-->
<!--                                    <div class="col-4 col-md-2 text-center">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h3>4</h3>-->
<!--                                            </div>-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h3>Sept</h3>-->
<!--                                                <hr class="m-2">-->
<!--                                            </div>-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h6 class="mb-0">Fri</h6>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-8 col-md-10 vl">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-12">-->
<!--                                                <span class="h4">-->
<!--                                                    Game of Thrones Trivia-->
<!--                                                </span>-->
<!--                                                <span class="h5">-->
<!--                                                    @ Railgarten-->
<!--                                                </span>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <h6 class="mt-2">7PM - 8PM</h6>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <p class="mb-0">-->
<!--                                                    <b>Reservation:</b> Not Required-->
<!--                                                </p>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <small class="mb-0" style="color: darkorange;">-->
<!--                                                    More Details-->
<!--                                                </small>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row pt-4">-->
<!--                    <div class="col-12 col-md-10 offset-md-1">-->
<!--                        <div class="fancy3 card">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row pt-3 pb-3">-->
<!--                                    <div class="col-4 col-md-2 text-center">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h3>4</h3>-->
<!--                                            </div>-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h3>Sept</h3>-->
<!--                                                <hr class="m-2">-->
<!--                                            </div>-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h6 class="mb-0">Fri</h6>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-8 col-md-10 vl">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-12">-->
<!--                                                <span class="h4">-->
<!--                                                    Game of Thrones Trivia-->
<!--                                                </span>-->
<!--                                                <span class="h5">-->
<!--                                                    @ Railgarten-->
<!--                                                </span>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <h6 class="mt-2">7PM - 8PM</h6>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <p class="mb-0">-->
<!--                                                    <b>Reservation:</b> Not Required-->
<!--                                                </p>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <small class="mb-0" style="color: darkorange;">-->
<!--                                                    More Details-->
<!--                                                </small>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row pt-4 pb-5">-->
<!--                    <div class="col-12 col-md-10 offset-md-1">-->
<!--                        <div class="fancy3 card">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row pt-3 pb-3">-->
<!--                                    <div class="col-4 col-md-2 text-center">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h3>4</h3>-->
<!--                                            </div>-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h3>Sept</h3>-->
<!--                                                <hr class="m-2">-->
<!--                                            </div>-->
<!--                                            <div class="col-md-12">-->
<!--                                                <h6 class="mb-0">Fri</h6>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-8 col-md-10 vl">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-12">-->
<!--                                                <span class="h4">-->
<!--                                                    Game of Thrones Trivia-->
<!--                                                </span>-->
<!--                                                <span class="h5">-->
<!--                                                    @ Railgarten-->
<!--                                                </span>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <h6 class="mt-2">7PM - 8PM</h6>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <p class="mb-0">-->
<!--                                                    <b>Reservation:</b> Not Required-->
<!--                                                </p>-->
<!--                                            </div>-->
<!--                                            <div class="col-12">-->
<!--                                                <small class="mb-0" style="color: darkorange;">-->
<!--                                                    More Details-->
<!--                                                </small>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash;footer&ndash;&gt;-->
<!--        <footer class="text-white" style="background-color: darkorange;">-->
<!--            <div class="container">-->
<!--                <div class="row pt-5">-->
<!--                    <div class="col-md-6">-->
<!--                        <div class="row">-->
<!--                            <div class="col-md-12">-->
<!--                                <h1>Trivalo</h1>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row pt-2">-->
<!--                            <div class="col-md-12">-->
<!--                                <p>About</p>-->
<!--                            </div>-->
<!--                            <div class="col-md-12">-->
<!--                                <p>Contact Us</p>-->
<!--                            </div>-->
<!--                            <div class="col-md-12">-->
<!--                                <p>Plan an event</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row pt-3">-->
<!--                    <div class="col-md-12 text-center">-->
<!--                        <p>Created by Toti Cuervo</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </footer>-->
    </div>
</template>

<script>
    import TrivaloLogoAnimation from "./TrivaloLogoAnimation";
    export default {
        components: {TrivaloLogoAnimation},
        data() {
            return {

            }
        },
        methods: {
            goToPlay() {
                let route = "play";

                window.open(route, "_blank");
            }
        }
    }
</script>

<style scoped>

</style>
