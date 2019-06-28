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

    fetchQuestions({ commit, state }, trivia_id) {
        commit('setLoading', true);
        axios.get('/api/trivia/' + trivia_id + '/questions')
            .then(response => {
                console.log(response.data);
                commit('SET_QUESTIONS', response.data);
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    newQuestion({commit, state}) {
        commit('setLoading', true);
        axios.post('/api/question/create', state.form)
            .then(response => {
                commit('UPDATE_QUESTIONS', response.data);
                commit('CLEAR_FORM');
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    }

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
    UPDATE_QUESTIONS(state,question){
        state.questions.push(question);
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
            round_id: null,
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
