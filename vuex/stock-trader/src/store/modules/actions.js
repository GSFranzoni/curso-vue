import Vue from 'vue';

export default {
    loadData: function({ commit }) {
        Vue.prototype.$http.get('stocks.json').then(
            res => {
                const data = res.data;
                if(data) {
                    commit('setFunds', data.funds);
                    commit('setOrders', data.orders);
                    commit('setStocks', data.stocks);
                }
            }
        )
    },
    sendData: function() {
        Vue.prototype.$http.put('stocks.json', {
            orders: this.state.portfolio.orders,
            funds: this.state.portfolio.funds,
            stocks: this.state.stocks.stocks
        });
    }
}