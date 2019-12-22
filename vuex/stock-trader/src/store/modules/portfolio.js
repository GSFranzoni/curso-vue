export default {
    state: {
        orders: [
            {
                id: 1, price: 110, quantity: 15
            }
        ],
        funds: 1000
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
    },
    mutations: {
        buyStock: function(state, order) {
            state.orders.push(order);
            this.commit('setFunds', state.funds+(-order.price*order.quantity));
        },
        sellStock: function(state, {order, quantity, price}) {
            state.orders = state.orders.map(o => {
                if(order.id == o.id)
                    o.quantity-=quantity
                return o
            }).filter(o => {
                return o.quantity>0
            });
            this.commit('setFunds', state.funds+(quantity*price))
        },
        setOrders: function(state, orders) {
            state.orders = orders? orders: [];
        },
        setFunds: function(state, funds) {
            state.funds = funds;
        }
    },
    getters: {
        getOrders: function(state, getters) {
            // eslint-disable-next-line
            console.log(state.orders)
            return state.orders.map(
                o => {
                    o.name = getters.stocks.find(s => s.id == o.id).name;
                    return o;
                }
            )
        },
        getFunds(state) {
            return state.funds;
        }
    }
}