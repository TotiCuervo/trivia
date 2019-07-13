function initialState() {
    return {
        questions: [],
        question: null,
        form:{
            id: '',
            title: '',
            type: '',
            round_id: '',
            order_number: '',
        },
        loading: false,
    }
}

const getters = {
    questions(state){
        return state.questions;
    },
    questionObject(state){
        return state.question;
    },
    questionFields(state){
        return state.form;
    },
    formTitle(state){
        return state.form.title;
    },
    formType(state){
        return state.form.type;
    },
    formQuestionRoundID(state){
        return state.form.round_id;
    },
    formOrderNumber(state) {
        return state.form.order_number;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {

    fetchQuestion({ commit, state}, question_id)
    {

        commit('setLoading', true);
        axios.get('/api/question/' + question_id)
            .then(response => {
                commit('SET_QUESTION_FORM', response.data);
                commit('SET_QUESTION', response.data);

                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    fetchQuestions({ commit, state }, trivia_id) {
        commit('setLoading', true);
        axios.get('/api/trivia/' + trivia_id + '/questions')
            .then(response => {
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
                commit('SET_QUESTION', response.data);
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
    SET_QUESTION_FORM(state, question){

        state.form = {
            id: question.id,
            title: question.title,
            type: question.type,
            round_id: question.round_id,
            order_number: question.order_number
        };
    },
    UPDATE_TITLE(state,title){
        state.form.title = title;
    },
    UPDATE_ORDER_NUMBER(state,order_number){
        state.form.order_number = order_number;
    },
    UPDATE_QUESTION(state,question){
        state.question = question;
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
    DELETE_FROM_QUESTIONS(state, index){

        state.questions.splice(index-1,1);

        for (let $i = index-1; $i < state.questions.length; $i++) {

            state.questions[$i].order_number = state.questions[$i].order_number - 1;

            axios.post('/api/question/' + state.questions[$i].id, {
                data: state.questions[$i],
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
    CLEAR_FORM(state){
        state.form = {
            id: '',
            title: '',
            type: '',
            round_id: '',
            order_number: '',
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
