function initialState() {
    return {
        user: {
            name: 'Loading...',
            email: 'Loading...',
            id: 'Loading...'
        },
        loading: false,
        form:{
        }
    }
}

const getters = {
    user(state){
        return state.user;
    },
    name(state){
        return state.user.name;
    },
    email(state){
        return state.user.email;
    },
    user_id(state){
        return state.user.id;
    },
    loading(state){
        return state.loading;
    },
};

const actions = {
    fetchData({ commit, state }) {

        commit('setLoading', true);

        console.log('made it');

        axios.get('/api/user')
            .then(response => {
                commit('SET_USER', response.data);
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
    SET_USER(state,user){
        state.user = user;
    }

};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
