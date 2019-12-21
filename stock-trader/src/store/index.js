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
        sellStock: function(state, {order, quantity, price}) {
            state.orders = state.orders.map(o => {
                if(order.id == o.id)
                    o.quantity-=quantity
                return o
            }).filter(o => {
                return o.quantity>0
            });
            this.commit('updateFunds', quantity*price)
        },
        updateFunds: function(state, price) {
            state.funds+=price;
            // eslint-disable-next-line
            console.log(state.funds)
        },
        setData: function(state, {orders, stocks, funds}) {
            state.orders = orders;
            state.stocks = stocks;
            state.funds = funds;
        },
        generate: function() {
            this.state.stocks = this.state.stocks.map(stock => {
                stock.price = Math.max(0, Math.round(((Math.random()-0.5)*25)+stock.price));
                return stock;
            })
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
        sellStock: function({commit}, {order, quantity, price}) {
            if(quantity<=0) {
                throw new Error('Quantidade inválida!');
            }
            if(order.quantity<quantity) {
                throw new Error('Você não tem essa quantidade de ações!');
            }
            commit('sellStock', {order, quantity, price});
        },
        loadData: function({ commit }) {
            Vue.prototype.$http.get('stocks.json').then(
                res => {
                    const data = res.data;
                    if(data)
                        commit('setData', data);
                }
            )
        },
        sendData: function() {
            Vue.prototype.$http.put('stocks.json', this.state);
        },
        generate: function({ commit }) {
            commit('generate');
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
