<template>

    <div class="round-card card" v-bind:class="{'clicker': this.current_Round.order_number !== this.round.order_number}" @click="clickToEdit()">
        <div class="p-4">
            <div class="round-details">
                <div class="row pb-3" v-show="(this.current_Round.order_number !== this.round.order_number)">
                    <!--Round index-->
                    <div class="col-12 pr-0">
                        <span class="font-weight-bold mt-2 h6">
                            Round: {{this.round.order_number}}
                            <span v-if="this.round.title"> / {{this.round.title}}</span>
                            <span v-if="this.round.time"> / {{this.round.time}}s Questions</span>
                            <span v-if="!this.round.time"> / No Time Limit</span>
                        </span>
                    </div>
                </div>
                <div class="row pb-3" v-show="(this.current_Round.order_number === this.round.order_number)">
                    <div class="col-3 col-sm-2 col-md-2 pr-0">
                        <h6 class="float-left font-weight-bold mt-2">Round: {{this.round.order_number}}</h6>
                    </div>
                    <!--Round Description-->
                    <div class="col-4 col-md-3 pl-0">
                        <b-form  @submit.stop.prevent>
                            <b-input
                                v-model="round_Title"
                                placeholder="Round Title"
                                :state="null"
                                id="feedbacek-user"
                                size="sm"
                                @input="updateTitle()"
                                v-if="validation">
                            </b-input>

                            <b-input
                                v-model="round_Title"
                                placeholder="Round Title"
                                :state="validation"
                                id="feedback-user"
                                size="sm"
                                @input="updateTitle()"
                                v-if="!validation">

                            </b-input>
                            <b-form-invalid-feedback :state="validation">
                                Cannot be longer than 20 characters.
                            </b-form-invalid-feedback>
                        </b-form>
                    </div>
                    <!--Time Limit-->
                    <div class="col-2 col-md-2 pl-0">
                        <b-form-select
                            v-model="round_Time"
                            size="sm"
                            @change="updateTime()"
                            :options="timeOptions">
                        </b-form-select>
                    </div>
                    <!--Delete Round-->
                    <div class="col-3 col-md-5">
                        <span class="size-1x5 first-gray then-black trans-1 clicker float-right" v-b-modal.delete-round>
                            <i class="far fa-times-circle"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!--question index-->
            <div class="question-index pt-4">
                <QuestionIndex :round_id="this.round.id"></QuestionIndex>
            </div>
            <!--add question via modal-->
            <div class="add-question" v-show="this.current_Round.order_number === this.round.order_number">
                <div class="row pt-3">
                    <div class="col-md-12 text-center">
                        <span class="fa-2x color-green" v-b-tooltip.hover title="Add Question!" v-b-modal.add-question>
                            <i class="fas fa-plus-circle"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                id: '',
                loading: false,
                timeOptions: [
                    { value: null, disabled: true, text: 'Question Time Limit' },
                    { value: null, text: 'No Time Limit' },
                    { value: '30', text: '30 Sec' },
                    { value: '60', text: '60 Sec' },
                    { value: '90', text: '90 Sec' },
                    { value: '120', text: '120 Sec' },
                ],
            }
        },
        mounted() {
            this.id = this.$route.params;
        },
        methods: {
            ...mapActions('round', ['fetchData', 'deleteRound']),
            clickToEdit() {

                if (this.current_Round !== this.round) {
                    this.$store.commit('question/CLEAR_CURRENT_QUESTION');
                    this.current_Round = this.round;
                }

            },
            updateTime() {

                this.loading = true;

                let $time = this.round_Time;

                setTimeout(() => {

                    if ($time === this.round_Time) {
                        if (this.validation) {
                            axios.post('/api/round/' + this.current_Round.id, {
                                data: this.current_Round,
                                _method: 'patch'
                            })
                                .then(response => {
                                    this.loading = false;
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                        }
                    }

                }, 500);

            },
            updateTitle() {

                this.loading = true;

                let $title = this.round_Title;

                setTimeout(() => {

                    if ($title === this.round_Title) {
                        // console.log('made it');
                        if (this.validation) {
                            // console.log('made it2');
                            axios.post('/api/round/' + this.current_Round.id, {
                                data: this.current_Round,
                                _method: 'patch'
                            })
                                .then(response => {
                                    this.loading = false;
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                        }
                    }

                }, 1000);

            },
            delete_Round(){
                this.deleteRound();
            },
        },
        computed: {
            ...mapGetters('round', ['currentRound']),
            round_Title: {
                get() {
                    return this.currentRound.title;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_ROUND_TITLE', value);
                }
            },
            round_Time: {
                get() {
                    return this.currentRound.time;
                },
                set(value) {
                    this.$store.commit('round/UPDATE_ROUND_TIME', value);
                }
            },
            current_Round: {
                get() {
                    return this.currentRound;

                },
                set(value) {
                    this.$store.commit('round/UPDATE_ROUND', value);
                },
            },
            validation() {

                if (this.round_Title !== null) {
                    return this.round_Title.length < 20
                }

            }
        },
        props: ['round']
    }
</script>

<style scoped>

</style>
