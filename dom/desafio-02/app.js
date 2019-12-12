new Vue({
    el: '#desafio',
    data: {
        valor: ''
    },
    methods: {
        exibirAlerta(evt) {
            alert('Alertando!');
        },
        keyDown(evt) {
            this.valor = evt.target.value;
        }
    }
})