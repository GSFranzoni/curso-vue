export default {
    state: {
        produtos: []
    },
    getters: {
        total: function(state) {
            return state.produtos
                .map(
                    produto => produto.preco * produto.quantidade)
                .reduce(
                    (total, atual) => total + atual, 0
                );
        }
    },
    mutations: {
        adicionarProduto: function(state, produto) {
            state.produtos.push(produto);
        }
    },
    actions: {
        adicionarProduto: function({ commit }, payload) {
            setTimeout(() => {
                commit('adicionarProduto', payload)
            }, 1000)
        }
    }
}