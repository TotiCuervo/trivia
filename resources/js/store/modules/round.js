function initialState() {
    return {
        rounds: [],
        currentRound: {
            id: '',
            title: '',
            time: '',
            round_type: '',
            game_id: '',
            order_number: '',
        },
        form:{
            title: '',
            time: '',
            round_type: '',
            game_id: '',
            order_number: '',
        }
    }
}

const getters = {
    currentRound(state){
        return state.currentRound;
    },
    rounds(state){
        return state.rounds;
    },
    roundCount(state){
        return state.rounds.length;
    },
    formTitle(state){
        return state.form.title;
    },
    formGameID(state){
        return state.form.game_id;
    },
    formOrderNumber(state){
        return state.form.order_number;
    },
    formRoundType(state){
        return state.form.round_type;
    },
    formData(state){
        return state.form;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {

    fetchRounds({ commit, state }, game) {

        commit('setLoading', true);
        axios.get('/api/game/'+game.id+'/rounds')
            .then(response => {
                commit('SET_ROUNDS', response.data);
                commit('UPDATE_ORDER_NUMBER');
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    fetchRoundsByGameCode({ commit, state }, gameCode) {

        commit('setLoading', true);
        axios.get('/api/game/'+gameCode+'/roundsByCode')
            .then(response => {
                commit('SET_ROUNDS', response.data);
                commit('UPDATE_ORDER_NUMBER');
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    addRound({commit, state}) {

        let $roundForm = {
            title: '',
            time: '',
            round_type: 'play',
            game_id: state.form.game_id,
            order_number: state.rounds.length + 1,
        };

        commit('setLoading', true);
        axios.post('api/round/create', $roundForm)
            .then(response => {
                commit('ADD_ROUND', response.data);
                commit('UPDATE_ORDER_NUMBER');
                commit('setLoading', false);
                // commit('CLEAR_FORM');
            }).catch( error => {
            console.log(error.response)
        });

    },

    addBreak({commit, state}) {
        let $roundForm = {
            title: '',
            time: '',
            round_type: 'break',
            game_id: state.form.game_id,
            order_number: state.rounds.length + 1,
        };

        commit('setLoading', true);
        axios.post('api/round/create', $roundForm)
            .then(response => {
                commit('ADD_ROUND', response.data);
                commit('UPDATE_ORDER_NUMBER');
                commit('setLoading', false);
                // commit('CLEAR_FORM');
            }).catch( error => {
            console.log(error.response)
        });

    },

    deleteRound({commit, state}) {
        commit('setLoading', true);
        axios.delete('api/round/' + state.currentRound.id+'/destroy')
            .then(response => {
                commit('DELETE_FROM_ROUNDS', state.currentRound.order_number);
                commit('CLEAR_ROUND');
                commit('UPDATE_ORDER_NUMBER');
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response)
        });


    }

};

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
    SET_ROUNDS(state,rounds){
        state.rounds = rounds;
    },
    UPDATE_ROUND(state,round) {
        state.currentRound = round;
    },
    UPDATE_ROUND_BY_ID(state, id){
        console.log('made it');
        for (let $i= 0; $i < state.rounds.length; $i++) {
            console.log('made it inside');
            console.log(state.rounds);

            if (state.rounds[$i].id === id) {
                console.log('made it 2');
                state.currentRound = state.rounds[$i];
            }
        }
    },
    UPDATE_ROUND_TITLE(state,title){
        state.currentRound.title = title;
    },
    UPDATE_ROUND_TIME(state,time){
        state.currentRound.time = time;
    },
    UPDATE_TITLE(state,title){
        state.form.title = title;
    },
    UPDATE_GAME_ID(state, gameID){
        state.form.game_id = gameID;
    },
    UPDATE_LIST(state, value){

        for (let $i = 0; $i < state.rounds.length; $i++) {
            if (state.rounds[$i].id !== value[$i].id) {
                let $form = {
                    id: value[$i].id,
                    title: value[$i].title,
                    time: value[$i].time,
                    round_type: value[$i].round_type,
                    game_id: value[$i].game_id,
                    order_number: state.rounds[$i].order_number,
                };

                axios.post('/api/round/' + $form.id, {
                    data: $form,
                    _method: 'patch'
                })
                    .then(response => {
                        // console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });

                Vue.set(value, $i, $form );
            }
        }

        state.rounds = value;
    },
    UPDATE_ORDER_NUMBER(state){
        state.form.order_number = state.rounds.length + 1;
    },
    UPDATE_ROUND_TYPE(state, round_type){
        state.form.round_type = round_type;
    },
    ADD_ROUND(state, round){
        state.rounds.push(round);
    },
    DELETE_FROM_ROUNDS(state, index) {

        state.rounds.splice(index-1,1);

        for (let $i = index-1; $i < state.rounds.length; $i++) {

            state.rounds[$i].order_number = state.rounds[$i].order_number - 1;

            axios.post('/api/round/' + state.rounds[$i].id, {
                data: state.rounds[$i],
                _method: 'patch'
            })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });

        }

    },
    CLEAR_ROUND(state){
        state.currentRound = {
            id: '',
            title: '',
            time: '',
            round_type: '',
            game_id: '',
            order_number: '',
        }
    },
    CLEAR_FORM(state){
        state.form = {
            title: null,
            game_id: null,
            order_number: null,
            round_type:null,
        };
    },
    CLEAR_ROUNDS(state){
        state.rounds = [];
    }

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
