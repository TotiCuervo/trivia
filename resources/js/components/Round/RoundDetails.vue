<template>

    <div class="fancy card" @click="clickToEdit()">
        <div class="p-4">
            <div class="round-details">
                <div class="row pb-3">
                    <div class="col-md-2 pr-0">
                        <h5 class="float-left">Round: {{this.round.order_number}}</h5>
                    </div>
                    <div class="col-md-3 pl-0">
                        <div v-show="(this.current_Round.order_number !== this.round.order_number) && (this.round.title != null)">
                            <h5 class="text-muted"> {{this.round.title}} </h5>
                        </div>
                        <div v-show="this.current_Round.order_number === this.round.order_number">
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
                    </div>
                    <div class="col-md-3 pl-0">
                        <div v-show="(this.current_Round.order_number !== this.round.order_number)">
                            <div v-if="this.round.time === null">

                                <h5 class="text-muted">No Time Limit</h5>
                            </div>
                            <div v-else>
                                <h5 class="text-muted"> {{this.round.time}} second questions  </h5>
                            </div>
                        </div>
                        <div v-show="this.current_Round.order_number === this.round.order_number">
                            <b-form-select
                                    v-model="round_Time"
                                    size="sm"
                                    @change="updateTime()"
                                    :options="timeOptions">
                            </b-form-select>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0">
                        <div class="save-data" v-show="this.current_Round.order_number === this.round.order_number">
                            <div v-if="this.loading === true">
                                <b-button variant="info" class="float-right" size="sm">
                                    <b-spinner small></b-spinner>
                                    Saving...
                                </b-button>
                            </div>
                            <div v-else>
                                <b-button variant="outline-info" class="float-right" size="sm">
                                    <i class="fas fa-check faa-tada animated"></i>
                                    Up To Date
                                </b-button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="float-right" v-show="this.current_Round.order_number === this.round.order_number">
                            <i class="far fa-times-circle fa-1x5 fa-gray-black clicker"  v-b-modal.delete-round></i>
                        </div>

                    </div>
                </div>
            </div>
            <div class="question-index pt-4">
                <QuestionIndex :round_id="this.round.id"></QuestionIndex>
            </div>
            <div class="add-question" v-show="this.current_Round.order_number === this.round.order_number">
                <div class="row pt-3">
                    <div class="col-md-12 text-center">
                        <router-link :to="{ name: 'createQaForm', params: { id: id.id, round_id: this.round.id } }"><i class="fas fa-plus-circle fa-green  fa-2x" v-b-tooltip.hover title="Add Question!"></i></router-link>
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