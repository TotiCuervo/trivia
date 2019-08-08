function initialState() {
    return {
        team: {
            name: '',
            token: ''
        },
        loading: false,
    }
}

const getters = {
    team(state){
        return state.team;
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
        state.team.name = team.name;
        state.team.token = team.token;
    },
    SET_TOKEN(state, token){
        state.team.token = token;
    },
    SET_NAME(state, name){
        state.team.name = name;
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
