const state = {
    iss: {
      login: 'http://localhost:8000/api/login',
      signup: 'http://localhost:8000/api/signup',
    },
    token: null,
  };
  
  const mutations = {
    setToken(state, token) {
      state.token = token;
    },
    removeToken(state) {
      state.token = null;
    },
  };
  
  const actions = {
    handleToken({ commit }, token) {
      commit('setToken', token);
    },
    removeToken({ commit }) {
      commit('removeToken');
    },
  };
  
  const getters = {
    getToken(state) {
      return state.token;
    },
    isValidToken(state) {
      const token = state.token;
      if (token) {
        const payload = JSON.parse(atob(token.split('.')[1]));
        return Object.values(state.iss).indexOf(payload.iss) > -1 ? true : false;
      }
      return false;
    },
  };
  
  export default {
    state,
    mutations,
    actions,
    getters,
  };