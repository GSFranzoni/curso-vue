<template>
    <div class="componente">
        <h2>As Informações de Usuário</h2>
        <p>Vários detalhes...</p>
        <p>Nome do usuário: <strong>{{ inverterNome() }}</strong></p>
        <p>Idade: <strong>{{ idade }}</strong></p>
        <button @click="reiniciarNome">Reiniciar nome</button>
        <button @click="reiniciarNomeFn">Reiniciar nome function</button>
    </div>
</template>

<script>

import Barramento from '@/Barramento';

export default {
    props: {
        nome: {
            type: String,
            required: true,
            // default: function() {
            //     return Array(10).fill(0).join(',');
            // }
        },
        reiniciarNomeFn: Function,
        idade: Number
    },
    data: function() {
        return {
            
        }
    },
    methods: {
        inverterNome: function() {
            return this.nome.split('').reverse().join('');
        },
        reiniciarNome: function() {
            this.nome = 'Pedro';
            this.$emit('nomeMudou', this.nome);
        }
    },
    created: function() {
        Barramento.quandoIdadeMudar((idade) => {
            this.idade = idade;
        })
    }
}
</script>

<style scoped>
    .componente {
        flex: 1;
        background-color: #ec485f;
        color: #fff;
    }
</style>
