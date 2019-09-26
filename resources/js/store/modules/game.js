function initialState() {
    return {
        games: [],
        game: {
            name: null,
            description: null,
            id: null,
            company: null
        },
        gameCode: '',
        loading: false,
        form:{
            name: null,
            user_id: null,
            company: null,
            description: null,
        }
    }
}

const getters = {
    game(state){
        return state.game;
    },
    games(state){
        return state.games;
    },
    name(state){
        return state.game.name;
    },
    gameCode(state){
        return state.gameCode;
    },
    description(state){
        return state.game.description;
    },
    game_id(state){
        return state.game.id;
    },
    company(state){
        return state.game.company;
    },
    formName(state){
        return state.form.name;
    },
    formUser(state){
        return state.form.user_id;
    },
    formCompany(state){
        return state.form.company;
    },
    formDescription(state){
        return state.form.description;
    },
    loading(state){
        return state.loading;
    },
    current(state){
        return state.current;
    },
};

const actions = {

    fetchData({ commit, state }, id) {

        commit('setLoading', true);

        axios.get('/api/game/'+id.id)
            .then(response => {
                commit('SET_GAME', response.data);
                commit('setLoading', false);
            })
            .catch( error => {
                console.log(error.response);
            });
    },

    fetchDataByGameCode({ commit, state}, gameCode) {
        commit('setLoading', true);

        axios.get('/api/game/'+ gameCode + '/code')
            .then(response => {
                commit('SET_GAME', response.data);
                commit('setLoading', false);
            })
            .catch( error => {
                console.log(error.response);
            });
    },

    fetchGames({ commit, state }, id) {
        commit('setLoading', true);
        axios.get('api/games/'+ id).
        then(response => {
            commit('SET_GAMES', response.data);
            commit('setLoading', false);
            this.games = response.data
        });
    },

    deleteGame({ commit, state }) {
        commit('setLoading',true);
        axios.delete('/api/game/' + state.game.id +'/destroy')
            .then(response => {
                commit('DELETE_FROM_GAMES', response.data);
                commit('setLoading', false);
            })
            .catch(error => {
                console.log(error);
            });
    },

    updateGame({commit, state}) {
        commit('setLoading', true);
        axios.post('/api/game/' + state.game.id, {
            data: state.game,
            _method: 'patch'
        })
            .then(response => {
                // console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },

    newGame({commit,state}) {
        axios.post('/api/game/create', state.game)
            .then(response => {
                return response.data;
        });
    },

    createFreshGameCode({commit, state}, game) {
        axios.post('/api/gameCode/' + game.id + '/create', {
        })
            .then(response => {
                console.log(response.data);
                localStorage.setItem('gameCode', JSON.stringify(response.data));
                commit('SET_GAME_CODE', response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }

};

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
    SET_GAME(state, game){
        state.game = game;
    },
    SET_GAMES(state, games) {
        state.games = games;
    },
    ADD_GAME(state,game) {
        state.games.push(game);
    },
    SET_GAME_CODE(state,code) {
        state.gameCode = code;
    },
    UPDATE_GAME_NAME(state,name) {
        state.game.name = name;
    },
    UPDATE_GAME_DESCRIPTION(state,description) {
        state.game.description = description;
    },
    UPDATE_GAME_COMPANY(state,company) {
        state.game.company = company;
    },
    DELETE_FROM_GAMES(state,game) {

        for (let $i = 0; $i < state.games.length; $i++) {

            if (state.games[$i].id === game.id) {
                state.games.splice($i, 1);
            }
        }
    }

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
