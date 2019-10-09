function initialState() {
    return {
        user: {
            name: 'Loading...',
            email: 'Loading...',
            id: null
        },
        loading: false,
        darkMode: false,
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
    darkMode(state) {
        return state.darkMode;
    }
};

const actions = {
    fetchData({ commit, state }) {

        commit('setLoading', true);

        axios.get('/api/user')
            .then(response => {
                let user = response.data;
                commit('SET_USER', response.data);
                commit('SET_USER_ID', user.id);
                commit('setLoading', false);
            }).catch( error => {
            console.log(error.response);
        });
    },

    toggleDarkMode({commit, state}) {
        commit('TOGGLE_DARK_MODE');
    }

};

const mutations = {
    setLoading(state, loading) {
        state.loading = loading
    },
    SET_USER(state,user){
        state.user = user;
    },
    SET_USER_ID(state, user_id){
        state.user.id = user_id;
    },
    TOGGLE_DARK_MODE(state) {
        state.darkMode = !state.darkMode;
    }


};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
