function initialState() {
    return {
        answers: [],
        answer: null,
        form:{
            title: null,
            question_id: null,
            round_id: null,
            correct: true,
        }
    }
}

const getters = {
    answers(state){
        return state.answers;
    },
    answer(state){
        return state.answer;
    },
    answerFields(state){
        return state.form;
    },
    formTitle(state){
        return state.form.title;
    },
    formQuestionID(state){
        return state.form.question_id;
    },
    formAnswerRoundID(state){
        return state.form.question_id;
    },
    formCorrect(state){
        return state.form.correct;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {

    fetchAnswers({ commit, state }, trivia_id) {
        commit('setLoading', true);
        console.log(trivia_id);
        axios.get('/api/trivia/' + trivia_id + '/answers')
            .then(response => {
                commit('SET_ANSWERS', response.data);
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
    SET_ANSWER(state,answer){
        state.answer = answer;
    },
    SET_ANSWERS(state, answers){
        state.answers = answers;
    },
    UPDATE_TITLE(state,title){
        state.form.title = title;
    },
    UPDATE_ANSWERS(state,answer){
        state.answers.push(answer);
    },
    UPDATE_QUESTION_ID(state,question_id){
        state.form.question_id = question_id;
    },
    UPDATE_ROUND_ID(state,round_id){
        state.form.round_id = round_id;
    },
    UPDATE_CORRECT(state,correct){
        state.form.correct = correct;
    },
    CLEAR_FORM(state){
        state.form = {
            title: null,
            question_id: null,
            correct: null,
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
