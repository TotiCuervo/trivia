function initialState() {
    return {
        answers: [],
        answer: '',
        form: [
            {
                id: '',
                title: '',
                question_id: '',
                round_id: '',
                correct: false,
            },
            {
                id: '',
                title: '',
                question_id: '',
                round_id: '',
                correct: false,
            },
            {
                id: '',
                title: '',
                question_id: '',
                round_id: '',
                correct: false,
            },
            {
                id: '',
                title: '',
                question_id: '',
                round_id: '',
                correct: false,
            },
        ]
    }
}

const getters = {
    answers(state){
        return state.answers;
    },
    answer(state) {
        return state.answer;
    },
    answerFields(state){
        return state.form;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {

    fetchAnswers({ commit, state }, game_id) {
        commit('setLoading', true);
        axios.get('/api/game/' + game_id + '/answers')
            .then(response => {
                commit('SET_ANSWERS', response.data);
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    fetchAnswersByGameCode({ commit, state }, gameCode) {
        commit('setLoading', true);
        axios.get('/api/game/' + gameCode + '/answersByCode')
            .then(response => {
                commit('SET_ANSWERS', response.data);
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    fetchQuestionAnswers({ commit, state }, question_id) {

        commit('setLoading', true);
        axios.get('/api/question/' + question_id + '/answers')
            .then(response => {
                commit('SET_ANSWERS_FORM', response.data);
                commit('SET_ANSWERS', response.data);
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    deletedAnswer({commit,state}, order_num) {

        while (order_num < state.form.length - 1)
        {
            commit('DELETED_ANSWER', order_num);

            order_num = order_num + 1;
        }
    }

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
    SET_ANSWERS_FORM(state, answers){

        let $newForm = {};

        for(let $i = 0; $i < answers.length; $i++)
        {

            $newForm = {
                id: answers[$i].id,
                title: answers[$i].title,
                question_id: answers[$i].question_id,
                round_id: answers[$i].round_id,
                correct: answers[$i].correct,
            };

            Vue.set(state.form, $i, $newForm );
        }
    },
    UPDATE_TITLE(state, payload){
        let $form = {
            id: state.form[payload.order].id,
            title: payload.title,
            question_id: state.form[payload.order].question_id,
            round_id: state.form[payload.order].round_id,
            correct: state.form[payload.order].correct,
        };

        Vue.set(state.form, payload.order, $form );

    },
    UPDATE_ANSWERS(state,answer){
        for (let $i=0; $i < state.answers.length; $i++) {

            if (answer.id === state.answers[$i].id) {
                Vue.set(state.answers, $i, answer);
                break;
            }
        }
    },
    ADD_TO_ANSWERS(state,answer){
        state.answers.push(answer);
    },
    UPDATE_QUESTION_ID(state,payload){
        state.form[payload.order].question_id = payload.questionID;
    },
    UPDATE_ROUND_ID(state,round_id){
        state.form.round_id = round_id;
    },
    UPDATE_CORRECT(state, order){
        state.form[order].correct = !(state.form[order].correct);
    },
    DELETED_ANSWER(state, order){
        state.form[order].title = state.form[order+1].title;
        state.form[order].correct = state.form[order+1].correct;
    },
    DELETE_FROM_ANSWERS(state, question) {

        for (let $i=0; $i < state.answers.length; $i++) {
            if (question.id === state.answers[$i].id) {state.answers.splice($i,1); break;}
        }
    },
    CLEAR_FORM(state, order){
        state.form[order] = {
            id: '',
            title: '',
            question_id: '',
            round_id: '',
            correct: false,
        };
    },
    CLEAR_ALL_FORM(state){
        state.form = [
            {
                id: '',
                title: '',
                question_id: '',
                round_id: '',
                correct: false,
            },
            {
                id: '',
                title: '',
                question_id: '',
                round_id: '',
                correct: false,
            },
            {
                id: '',
                title: '',
                question_id: '',
                round_id: '',
                correct: false,
            },
            {
                id: '',
                title: '',
                question_id: '',
                round_id: '',
                correct: false,
            },
        ]
    },
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
