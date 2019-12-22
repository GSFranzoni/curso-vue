export default {
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
    },
    actions: {
        generate: function ({ commit }) {
            commit('generate');
        }
    },
    mutations: {
        generate: function (state) {
            state.stocks = state.stocks.map(stock => {
                stock.price = Math.max(0, Math.round(((Math.random() - 0.5) * 50) + stock.price));
                return stock;
            })
        },
        setStocks: function(state, stocks) {
            state.stocks = stocks;
        }
    },
    getters: {
        stocks: function(state) {
            return state.stocks;
        }
    }
}