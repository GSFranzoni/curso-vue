export default {
    state: {
        quantidade: 0,
        preco: 0
    },
    mutations: {
        setQuantidade: function(state, quantidade) {
            state.quantidade = quantidade;
        },
        setPreco: function(state, preco) {
            state.preco = preco;
        }
    }
}