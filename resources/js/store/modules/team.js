function initialState() {
    return {
        teams: [],
        team: {
            id: '',
            name: '',
            token: '',
            gameCode: '',
            points: '',
            double: '',
            triple: ''
        },
        answers: [],
        loading: false,
    }
}

const getters = {
    team(state){
        return state.team;
    },
    teams(state){
        return state.teams;
    },
    teamAnswers(state){
        return state.answers;
    },
    name(state){
        return state.team.name;
    },
    double(state){
        return state.team.double;
    },
    triple(state){
       return state.team.triple;
    },
    token(state){
        return state.team.token;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {
    fetchData({ commit, state }) {

        commit('setLoading', true);

        axios.get('/api/team')
            .then(response => {
                console.log(response.data);
                commit('SET_TEAM', response.data);
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },
    fetchTeamAnswers({ commit, state }) {

        commit('setLoading', true);

        axios.post('/api/team/'+ state.team.id +'/answers')
            .then(response => {
                console.log(response.data);
                commit('SET_TEAM_ANSWERS', response.data);
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },
    updateTeamAnswerCorrect({commit, state}, answer) {

        axios.post('/api/teamAnswers/' + answer.id + '/updateCorrect')
            .then (response => {

                commit('UPDATE_TEAM', response.data);
                commit('SET_TEAM', response.data);
            });

        commit('UPDATE_TEAM_ANSWER', {
            answer: answer.answer,
            id: answer.id,
            question_id: answer.question_id,
            round_id: answer.round_id,
            team_id: answer.team_id,
            correct: !(answer.correct) === true ? 1 : 0,
            gameCode: answer.gameCode,
            matchIndex: answer.matchIndex,
            points: answer.points,
            powerUp: answer.powerUp,
        });
    },
    deleteTeam({commit, state}) {
        console.log('deleted a team');
        axios.post('/api/team/'+ state.team.id +'/delete')
            .then (response => {
                commit('SET_TEAMS', response.data)
            });
    }


};

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
    SET_TEAM(state,team){
        state.team = team;
    },
    SET_TEAMS(state,teams) {
        state.teams = teams;
    },
    SET_TEAM_ANSWERS(state,answers) {
        for (let $i=0; $i < answers.length; $i++) {
            state.answers.push(answers[$i]);
        }
    },
    SET_TOKEN(state, token){
        state.team.token = token;
    },
    SET_NAME(state, name){
        state.team.name = name;
    },
    ADD_TEAM(state, team){
        state.teams.push(team);
    },
    REMOVE_TEAM(state, team) {

        for (let $i = 0; $i < state.teams.length; $i++) {

            if (team.name = state.teams[$i].name) {
                state.teams.splice($i-1,1);
            }
        }
    },
    ADD_TEAM_ANSWER(state, answer) {
        state.answers.push(answer);
    },
    UPDATE_TEAM_ANSWER(state, answer) {

        for (let $i=0; $i < state.answers.length; $i++) {
            if (answer.id === state.answers[$i].id) {
                Vue.set(state.answers, $i, answer);
                break;
            }
        }
    },
    UPDATE_TEAM_NAME(state, name) {
        state.team.name = name;
    },
    UPDATE_DOUBLE(state, double) {
        state.team.double = double;
    },
    UPDATE_TRIPLE(state, triple) {
        state.team.triple = triple;
    },
    UPDATE_TEAM(state, team) {
        for (let $i = 0; $i < state.teams.length; $i++) {
            if (state.teams[$i].id === team.id) {
                Vue.set(state.teams, $i, team);
                break;
            }
        }
    },
    CLEAR_FORM(state){
        state.team = {
            name: '',
            token: ''
        };
    }

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
