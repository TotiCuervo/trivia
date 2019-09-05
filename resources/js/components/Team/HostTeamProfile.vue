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
                        <i class="fas fa-user-edit fa-1x5 pr-2 clicker fa-gray hover-yellow" v-b-tooltip.bottom title="Edit Name"
                            @click="clicked('edit')"></i>
                        <i class="fas fa-trash-alt fa-1x5 clicker fa-gray hover-red" v-b-tooltip.bottom title="Delete User"
                            @click="clicked('delete')"></i>
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
        <div class="row pt-2">
            <div class="col-12">
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
                axios.post('/api/team/'+ this.team.id +'/edit', {
                    name: this.nameChange
                }).then (response => {
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