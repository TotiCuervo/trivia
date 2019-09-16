<template>
    <div>
        <div class="row">
            <div class="col-5">
                <h3 v-if="click !== 'edit'">{{this.nameChange}}</h3>
                <b-form-input size="lg" v-else v-model="nameChange"></b-form-input>
            </div>
            <div class="col-7">
                <div class="float-right">
                    <div v-if="click === ''">
                        <span class="size-1x5 pr-2 clicker first-gray then-yellow" v-b-tooltip.bottom title="Edit Name"
                              @click="clicked('edit')">
                            <i class="fas fa-user-edit"></i>
                        </span>
                        <span class="size-1x5 clicker first-gray then-red" v-b-tooltip.bottom title="Delete User"
                              @click="clicked('delete')">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                    </div>
                    <div v-else-if="click === 'edit'">
                        <button type="button" class="btn btn-success btn-lg mr-2" @click="saveName()">Save</button>
                    </div>
                    <div v-else>
                        <h4>
                            <span>Are you sure?:
                                <span class="clicker hover-red" @click="deleteUser()"><b>Yes</b></span>
                                /
                                <span class="clicker hover-green" @click="notClicked()"><b>No</b></span>
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-12">
                <h4>Points: {{this.team.points}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pl-2">
                <div class="size-2x5">
                    <span class="fa-layers fa-fw clicker text-really-muted" v-if="team.double === 0" v-b-tooltip.top title="Still available">
                        <i class="fas fa-certificate"></i>
                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5" style="font-weight:900">2X</span>
                    </span>
                    <span class="fa-layers fa-fw clicker" v-else v-b-tooltip.top title="2X used">
                        <i class="fas fa-certificate"></i>
                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5" style="font-weight:900">2X</span>
                    </span>
                    <span class="fa-layers fa-fw clicker text-really-muted" v-if="team.triple === 0" v-b-tooltip.top title="Still available">
                        <i class="fas fa-certificate"></i>
                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5" style="font-weight:900">3X</span>
                    </span>
                    <span class="fa-layers fa-fw clicker text-really-muted" v-else v-b-tooltip.top title="3X used">
                        <i class="fas fa-certificate"></i>
                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5" style="font-weight:900">3X</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-12">
                <hr>
                <HostTeamAnswerIndex></HostTeamAnswerIndex>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                click: '',
                nameChange: ''
            }
        },
        methods: {
            ...mapActions('team', ['deleteTeam']),
            clicked(value) {
                this.click = value;
            },
            notClicked() {
                this.click = '';
            },
            saveName() {
                axios.post('/api/team/' + this.team.id + '/edit', {
                    name: this.nameChange
                }).then(response => {
                    this.$store.commit('SET_TEAMS', response.data);
                });

                this.click = '';
            },
            deleteUser() {
                this.deleteTeam();
                this.$bvModal.hide('team');
            }
        },
        mounted() {
            this.nameChange = this.team.name;
        },
        computed: {
            ...mapGetters('team', ['team', 'teams', 'teamAnswers']),
            team_Answers: {
                get() {
                    return this.teamAnswers;
                },
                set(value) {
                    return this.$store.commit('team/UPDATE_TEAM_ANSWER_CORRECT', value);
                }
            }
        },
    }
</script>

<style scoped>

</style>