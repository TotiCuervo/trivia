<template>
    <div v-if="this.id">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <h5>Q{{question.order_number}}:</h5>
                    </div>
                    <div class="col-md-10" @click="toggleClicked()">
                        <div v-if="question.type === 'Fill-in-blank' ">
                            <span class="text-muted">(Fill In The Blank)</span>
                        </div>
                        <div v-else>
                            <span class="text-muted">(Multiple Choice)</span>
                        </div>
                        <h4>{{question.title}}</h4>
                    </div>
                    <div class="col-md-1">
                        <div class="float-right">
                            <div class="dropdown dropleft">
                                <i class="fas fa-ellipsis-v circle-icon" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <router-link :to="{ name: 'editQAForm', params: { id: id.id, round_id: round_id, question_id: question.id } }" class="nav-link">
                                        <a class="dropdown-item no-dec" href="#">
                                            <div class="row">
                                                <i class="fas fa-pen-square fa-1x5 align-middle pr-2 pl-2"></i> <p class="p-0 m-0">Edit</p>
                                            </div>
                                        </a>
                                    </router-link>

                                    <a class="dropdown-item" href="#">
                                        <div class="row">
                                            <i class="fas fa-trash fa-1x5 align-middle pr-2 pl-2"></i> <p class="p-0 m-0">Delete</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul v-show="clicked" class="list-group list-group-flush">
                <li class="list-group-item">
                    <AnswerIndex :question="question"></AnswerIndex>
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                id: '',
                clicked: false,
            }
        },
        mounted() {
            this.id = this.$route.params;
        },
        methods: {
            toggleClicked(){
                this.clicked = !(this.clicked);
            },
        },
        computed: {
        },
        props: ['question','round_id'],
    }
</script>

<style scoped>

</style>