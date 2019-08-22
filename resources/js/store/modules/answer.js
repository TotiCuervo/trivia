function initialState() {
    return {
        answers: [],
        answer: null,
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
            }
        ]
    }
}

const getters = {
    answers(state){
        return state.answers;
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

        while (order_num < 6)
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
            id: '',
            title: payload.title,
            question_id: '',
            round_id: '',
            correct: false,
        };

        Vue.set(state.form, payload.order, $form );

    },
    UPDATE_ANSWERS(state,answer){
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
    CLEAR_FORM(state, order){
        console.log("Clearing:");
        console.log(state.form[order]);
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
            }
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
