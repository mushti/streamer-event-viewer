import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: window.user
    },
    mutations: {
        logout (state) {
            state.user = null;
        },
        updateFavourite (state, update) {
            state.user.favorite = update;
        }
    }
});