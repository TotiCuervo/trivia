<template>
    <div>
        <div class="row pt-5">
            <div class="col-md-4 offset-md-4 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <b-form-input
                            @click="focusOnQuestion"
                            id="input-large"
                            size="lg"
                            placeholder="Enter your answer"
                            v-model="playerAnswer"
                            autocapitalize="none"
                            autocorrect="off"
                            autocomplete="off"
                            spellcheck="false">
                        </b-form-input>
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

            }
        },
        mounted() {

        },
        methods: {
            focusOnQuestion() {
                // window.scrollTo(0, 0);
                document.getElementById('question').scrollIntoView();
                // this.
            }


        },
        computed: {
            ...mapGetters('answer', ['answer']),
            playerAnswer: {
                get() {
                    return this.answer;
                },
                set(value) {
                    this.$store.commit('answer/SET_ANSWER', value);
                }
            }
        },
    }
</script>

<style scoped>

</style>
