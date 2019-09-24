function initialState() {
    return {
        questions: [],
        question: {
            id: '',
            title: '',
            type: '',
            round_id: '',
            order_number: '',
        },
        form:{
            id: '',
            title: '',
            type: '',
            round_id: '',
            order_number: '',
        },
        loading: false,
        loaded: false,
    }
}

const getters = {
    questions(state){
        return state.questions;
    },
    currentQuestion(state){
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
    loaded(state){
        return state.loaded;
    }
};

const actions = {

    fetchQuestion({ commit, state}, question_id) {

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

    fetchQuestions({ commit, state }, game_id) {
        commit('setLoading', true);
        axios.get('/api/game/' + game_id + '/questions')
            .then(response => {
                commit('SET_QUESTIONS', response.data);
                commit('setLoading', false);
                commit('SET_LOADED', true);
            }).catch( error => {
            console.log(error.response);
        });
    },

    fetchQuestionsByGameCode({ commit, state }, gameCode) {
        commit('setLoading', true);
        axios.get('/api/game/' + gameCode + '/questionsByCode')
            .then(response => {
                commit('SET_QUESTIONS', response.data);
                commit('setLoading', false);
                commit('SET_LOADED', true);
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
    },

    deleteQuestion({commit,state}) {
        commit('setLoading', true);
        axios.delete('/api/question/' + state.question.id +'/destroy')
            .then(response => {
                commit('DELETE_FROM_QUESTIONS', response.data);
                commit('setLoading', false);
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
    SET_QUESTION(state,question){
        state.question = question;
    },
    SET_QUESTIONS(state, questions){
        state.questions = questions;
    },
    SET_QUESTION_FORM(state, question){
        state.form = question;
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
    UPDATE_QUESTION_IN_QUESTIONS(state,question) {

        for (let $i=0; $i < state.questions.length; $i++) {

            if (state.questions[$i].id === question.id) {
                Vue.set(state.questions, $i, question);
                break;
            }
        }
    },
    ADD_QUESTION_TO_QUESTIONS(state,question){
        state.questions.push(question);
    },
    UPDATE_TYPE(state,type){
        state.form.type = type;
    },
    UPDATE_ROUND_ID(state,round_id){
        state.form.round_id = round_id;
    },
    UPDATE_LIST(state, value) {

        for (let $i = 0; $i < state.questions.length; $i++) {
            if (state.questions[$i].id !== value[$i].id) {
                let $form = {
                    id: value[$i].id,
                    title: value[$i].title,
                    type: value[$i].type,
                    round_id: value[$i].round_id,
                    order_number: state.questions[$i].order_number,
                };

                axios.post('/api/question/' + $form.id, {
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

        state.questions = value;
    },
    DELETE_FROM_QUESTIONS(state, question){

        let $roundQuestions = [];

        for (let $i = 0; $i < state.questions.length; $i++) {

            if (state.questions[$i].id === question.id) {
                state.questions.splice($i,1);
                break;
            }
        }

        for (let $i = 0; $i < state.questions.length; $i++) {
            if (state.questions[$i].round_id === question.round_id) {
                $roundQuestions.push(state.questions[$i]);
            }
        }

        for (let $i = question.order_number-1; $i < $roundQuestions.length; $i++) {

            $roundQuestions[$i].order_number = $roundQuestions[$i].order_number - 1;

            axios.post('/api/question/' + $roundQuestions[$i].id, {
                data: $roundQuestions[$i],
                _method: 'patch'
            })
                .then(response => {
                    // console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });

        }

    },
    CLEAR_CURRENT_QUESTION(state){

        state.question = {
            id: '',
            title: '',
            type: '',
            round_id: '',
            order_number: '',
        };
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
    SET_LOADED(state, value) {
        state.loaded = value;
    },
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
