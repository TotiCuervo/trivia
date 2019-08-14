function initialState() {
    return {
        teams: [],
        team: {
            id: '',
            name: '',
            token: '',
            gameCode: '',
        },
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
    name(state){
        return state.team.name;
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
