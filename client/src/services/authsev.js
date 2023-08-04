const state = {
    loggedIn: false,
  };
  
  const getters = {
    isAuthenticated: (state) => state.loggedIn,
  };
  
  const mutations = {
    setLoggedIn(state, value) {
      state.loggedIn = value;
    },
  };
  
  const actions = {
    changeAuthStatus({ commit }, value) {
      commit('setLoggedIn', value);
    },
  };
  
  export default {
    state,
    getters,
    mutations,
    actions,
  };
  