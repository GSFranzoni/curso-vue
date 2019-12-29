import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        isMenuVisible: true,
        user: null
    },
    mutations: {
        toggleMenu: function(state, isVisible) {
            if(!state.user) {
                state.isMenuVisible = false;
                return;
            }
            if(isVisible === undefined) {
                state.isMenuVisible = !state.isMenuVisible;
            }
            else {
                state.isMenuVisible = isVisible;
            }
        },
        setUser(state, user) {
            state.user = user;
            if(user) {
                axios.defaults.headers.common['Authorization'] = `${user.token}`;
            }
        }
    },
    actions: {
    },
    modules: {
    }
})
