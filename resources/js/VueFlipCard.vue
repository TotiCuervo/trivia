<template>
    <div>
        <div class="scene">
            <transition name="flip" mode="out-in">
                <div class="fancy3 card flipped-card" v-if="!this.clicked" key="slide1" style="padding: 50px 0px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5 class="m-0">
                                    HERE IS A BUNCH OF TEXT FOR YOU TO SEE IF THE OVERFLOW IS REALLY BAD I HOPE IT HELPS
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fancy3 card flipped-card" v-if="this.clicked" key="slide2" style="padding: 50px 0px;">
                    <div class="card-body">
                        <div class="row" style="margin-bottom: -30px;">
                            <div class="col-md-12 text-center">
                                <h5 class="m-0">
                                    HERE IS A BUNCH OF TEXT FOR YOU TO SEE IF THE OVERFLOW IS REALLY BAD I HOPE IT HELPS
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wrong-answer float-right">Wrong</div>
                        </div>
                    </div>
                </div>
            </transition>

        </div>

        <button type="button" class="btn btn-black" @click="toggleClicked()">click</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                clicked: false

            }
        },
        methods: {
            toggleClicked() {
                this.clicked = !this.clicked;
            }
        },
    }
</script>

<style scoped>

</style>
