<template>
    <div class="componente">
        <h2>Alterar os Dados de Usuário</h2>
        <p>Edite as informações</p>
        <p>Idade do usuário: <strong>{{ idade }}</strong></p>
        <button @click="alterarIdade">Alterar idade</button>
    </div>
</template>

<script>

import Barramento from '@/Barramento';

export default {
    props: ['idade'],
    methods: {
        alterarIdade: function() {
            this.idade+=1;
            Barramento.alterarIdade(this.idade);
        }
    }
}
</script>

<style scoped>
    .componente {
        flex: 1;
        background-color: #98b99a;
        color: #fff;
    }
</style>
