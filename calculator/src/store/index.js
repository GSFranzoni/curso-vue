import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        result: '0'
    },
    actions: {
        update: function({ commit }, key) {
            this.state.result = this.state.result in ['0', 'Syntax error'] && /^\d+$/.test(key)? '': this.state.result;
            commit('update', this.state.result + key);
        },
        calculate: function({ commit }) {
            let res;
            try {
                res = eval(this.state.result);
            }
            catch(exception) {
                res = 'Syntax error';
            }
            commit('update', res);
        },
        clear: function({ commit }) {
            commit('update', '0');
        }
    },
    mutations: {
        update: function(state, payload) {
            this.state.result = payload;
        }
    }
})