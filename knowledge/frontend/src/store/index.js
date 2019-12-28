import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        isMenuVisible: true,
        user: {
            name: 'Guilherme',
            email: 'gui@email.com.br'
        }
    },
    mutations: {
        toggleMenu: function(state, isVisible) {
            if(isVisible === undefined) {
                state.isMenuVisible = !state.isMenuVisible;
            }
            else {
                state.isMenuVisible = isVisible;
            }
        }
    },
    actions: {
    },
    modules: {
    }
})
