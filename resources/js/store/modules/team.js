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


};

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
    SET_TEAM(state,team){
        state.team.id = team.id;
        state.team.name = team.name;
        state.team.token = team.token;
        state.team.gameCode = team.gameCode;
        state.team.points = team.points;
        state.team.double = team.double;
        state.team.triple = team.triple;
    },
    SET_TEAMS(state,teams) {

        for (let $i=0; $i < teams.length; $i++) {

            let $team = {
                id: teams[$i].id,
                name: teams[$i].name,
                token: teams[$i].token,
                gameCode: teams[$i].gameCode
            };

            state.teams.push($team);
        }

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

        let $gameTeam = {
            id: team.id,
            name: team.name,
            token: team.token,
            gameCode: team.gameCode
        };

        state.teams.push($gameTeam);
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
    UPDATE_TEAM_ANSWER_CORRECT(state, payload) {

        axios.post('/api/teamAnswers/' + payload.answer.id + '/updateCorrect')
            .then (response => {
                // console.log(response.data);
            });

        Vue.set(state.answers, payload.order, {
            answer: payload.answer.answer,
            correct: !(payload.answer.correct) === true ? 1 : 0,
            gameCode: payload.answer.gameCode,
            id: payload.answer.id,
            matchIndex: payload.answer.matchIndex,
            points: payload.answer.points,
            powerUp: payload.answer.powerUp,
            question_id: payload.answer.question_id,
            team_id: payload.answer.team_id,
        });
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
