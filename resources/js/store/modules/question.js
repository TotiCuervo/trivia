function initialState() {
    return {
        questions: [],
        question: null,
        form:{
            title: null,
            type: null,
            round_id: null,
        }
    }
}

const getters = {
    questions(state){
        return state.questions;
    },
    question(state){
        return state.question;
    },
    formTitle(state){
        return state.form.title;
    },
    formType(state){
        return state.form.type;
    },
    formRoundID(state){
        return state.form.round_id;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {

    fetchRounds({ commit, state }) {

        commit('setLoading', true);

        axios.get('someURL')
            .then(response => {
                commit('SET_QUESTION', response.data);
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
    SET_QUESTION(state,question){
        state.question = question;
    },
    SET_QUESTIONS(state, questions){
        state.questions = questions;
    },
    UPDATE_TITLE(state,title){
        state.form.title = title;
    },
    UPDATE_TYPE(state,type){
        state.form.type = type;
    },
    UPDATE_ROUND_ID(state,round_id){
        state.form.round_id = round_id;
    },
    CLEAR_FORM(state){
        state.form = {
            title: null,
            type: null,
        };
    },
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
