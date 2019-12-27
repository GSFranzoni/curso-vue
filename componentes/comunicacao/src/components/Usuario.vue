<template>
    <div class="container">
        <h1>Componente Usuário</h1>
        <p>Esse é um componente muito legal!</p>
        <p>Nome do usuário: <strong>{{ nome }}</strong></p>
        <p>Idade: <strong>{{ idade }}</strong></p>
        <button @click="nome='Ana'">Alterar nome</button>
        <hr>
        <div class="componentes">
            <app-usuario-info :idade="idade" @nomeMudou="nomeMudou" :reiniciarNomeFn="reiniciarNome" :nome='nome' />
            <app-usuario-editar :idade="idade" />
        </div>
    </div>
</template>

<script>
import AppUsuarioInfo from './UsuarioInfo'
import AppUsuarioEditar from './UsuarioEditar'

export default {
    components: { AppUsuarioInfo, AppUsuarioEditar },
    data: function() {
        return {
            nome: 'Pedro',
            idade: 21
        }
    },
    methods: {
        nomeMudou: function($evt) {
            this.nome = $evt;
        },
        reiniciarNome: function() {
            this.nome = 'Pedro';
        },
        idadeMudou: function($evt) {
            this.idade = $evt;
        }
    }
}
</script>

<style scoped>
    .container {
        background-color: #27363b;
        color: #fff;
        padding: 10px;
    }

    .container hr {
        margin: 20px 10px;
    }

    .componentes {
        display: flex;
    }

    .componentes > * {
        margin: 10px;
    }
</style>
