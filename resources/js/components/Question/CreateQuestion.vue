<template>
    <div class="row pb-4">
        <div class="col-10 offset-1">
            <h1>{{this.title}}:</h1>
            <b-form-group>
                <b-form-textarea
                    id="textarea-state"
                    v-model.trim="questionTitle"
                    :state="null"
                    placeholder="Enter Question"
                    rows="2"
                    type="text"
                    required
                    v-if="validation"
                ></b-form-textarea>
                <b-form-textarea
                    id="textarea-state"
                    v-model.trim="questionTitle"
                    :state="validation"
                    placeholder="Enter Question"
                    rows="4"
                    required
                    v-if="!validation"
                ></b-form-textarea>
                <small v-if="validation">{{textLimit - questionTitle.length}}</small>
                <b-form-invalid-feedback :state="validation">
                    {{textLimit - questionTitle.length}}
                </b-form-invalid-feedback>
            </b-form-group>
        </div>
    </div>
</template>


<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                textLimit: 100,
            }
        },
        mounted() {

            //gets the params from the url
            this.routeParams = this.$route.params;

        },
        methods:{
        },
        props: ['title'],
        computed: {
            ...mapGetters('question', ['formTitle']),

            questionTitle: {
                get() {
                    return this.formTitle;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_TITLE', value);
                }
            },
            validation() {

                if (this.questionTitle !== null) {
                    return this.questionTitle.length < 100
                }

            }
        }
    }
</script>

<style scoped>

</style>
