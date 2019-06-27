function initialState() {
    return {
        objectArray: [],
        object: null,
        form:{
            fieldOne: null,
            fieldTwo: null,
        }
    }
}

const getters = {
    objectArray(state){
        return state.objectArray;
    },
    object(state){
        return state.object;
    },
    formFieldOne(state){
        return state.form.fieldOne;
    },
    formFieldTwo(state){
        return state.form.fieldTwo;
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
                commit('SET_OBJECT', response.data);
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
    SET_OBJECT(state,object){
        state.object = object;
    },
    SET_OBJECTARRAY(state, objectArray){
        state.objectArray = objectArray;
    },
    UPDATE_FIELDONE(state,fieldOne){
        state.form.fieldOne = fieldOne;
    },
    UPDATE_FIELDTWO(state,fieldTwo){
        state.form.fieldTwo = fieldTwo;
    },
    CLEAR_FORM(state){
        state.form = {
            fieldOne: null,
            fieldTwo: null,
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
