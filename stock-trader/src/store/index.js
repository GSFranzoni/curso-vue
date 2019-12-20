import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        stocks: [
            {
                id: 1, name: 'BMW', price: 110
            },
            {
                id: 2, name: 'Google', price: 200
            },
            {
                id: 3, name: 'Apple', price: 280
            }, 
            {
                id: 4, name: 'Twitter', price: 83
            }
        ],
        orders: [
            {
                id: 1, price: 110, quantity: 15
            }
        ],
        funds: 1000
    },
    mutations: {
        buyStock: function(state, order) {
            state.orders.push(order);
            this.commit('updateFunds', -order.price*order.quantity)
        },
        sellStock: function(state, {order, quantity}) {
            state.orders = state.orders.map(o => {
                if(order.id == o.id)
                    o.quantity-=quantity
                return o
            }).filter(o => {
                return o.quantity>0
            });
            this.commit('updateFunds', quantity*order.price)
        },
        updateFunds: function(state, price) {
            state.funds+=price;
            // eslint-disable-next-line
            console.log(state.funds)
        }
    },
    actions: {
        buyStock: function({commit}, order) {
            if(order.quantity<=0) {
                throw new Error('Quantidade inválida!');
            }
            if(order.price*order.quantity>this.state.funds) {
                throw new Error('Saldo insuficiente!');
            }
            commit('buyStock', order);
        },
        sellStock: function({commit}, {order, quantity}) {
            if(quantity<=0) {
                throw new Error('Quantidade inválida!');
            }
            if(order.quantity<quantity) {
                throw new Error('Você não tem essa quantidade de ações!');
            }
            commit('sellStock', {order, quantity});
        }
    },
    modules: {

    },
    getters: {
        getOrders: function(state) {
            return state.orders.map(
                o => {
                    o.name = state.stocks.find(s => s.id == o.id).name;
                    return o;
                }
            )
        }
    }
})
