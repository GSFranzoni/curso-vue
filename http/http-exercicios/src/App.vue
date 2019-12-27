<template>
    <div id="app" class="container">
        <h1>HTTP com Axios</h1>
        <b-alert 
        show 
        dismissible 
        v-for='mensagem in mensagens' 
        :variant="mensagem.tipo"
        :key='mensagem.texto'>{{ mensagem.texto }}</b-alert>
        <b-card>
            <b-card-header>Formulário</b-card-header>
            <b-card-body>
                <b-form-group label="Nome:">
                    <b-form-input
                        v-model="usuario.nome"
                        type="text"
                        size="lg"
                        placeholder="Informe o nome"
                    ></b-form-input>
                </b-form-group>
                <b-form-group label="E-mail:">
                    <b-form-input
                        v-model="usuario.email"
                        type="email"
                        size="lg"
                        placeholder="Informe o e-mail"
                    ></b-form-input>
                </b-form-group>
                <hr />
                <b-button @click="salvar">Salvar</b-button>
                <b-button class="ml-2" @click="obter" variant="success">Obter usuários</b-button>
            </b-card-body>
        </b-card>
        <b-list-group>
            <b-list-group-item v-for='(u, i) in usuarios' :key='i'>
                <hr />
                <strong>ID: </strong>{{ i }}<br>
                <strong>Nome: </strong>{{ u.nome }}<br>
                <strong>E-mail: </strong>{{ u.email }}<br>
                <b-button
                    variant="warning"
                    @click='carregar(i)'>Carregar</b-button>
                <b-button
                    class='ml-2'
                    variant="danger"
                    @click='excluir(i)'>Excluir</b-button>
            </b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data: function() {
        return {
            usuarios: [],
            usuario: {},
            id: null,
            mensagens: []
        };
    },
    methods: {
        limpar: function() {
            this.usuario = {};
            this.mensagens = [];
            this.id = null;
        },
        carregar: function(id) {
            this.id = id;
            this.usuario = { ...this.usuarios[id] };
        },
        excluir: function(id) {
            this.$http.delete(`usuarios/${id}.json`).then(
                res => {
                    this.limpar();
                    this.mensagens.push({
                        texto: 'Operação realizada com sucesso!',
                        tipo: 'success'
                    })
                }
            );
        },
        salvar: function() {
            const metodo = this.id ? 'patch': 'post';
            const final = this.id? `/${this.id}.json`: '.json';
            console.log(this.id)
            this.$http[metodo](`usuarios${final}`, this.usuario).then(
                res => {
                    this.limpar();
                    this.mensagens.push({
                        texto: 'Operação realizada com sucesso!',
                        tipo: 'success'
                    })
                },
                err => {
                    console.log(err);
                    this.mensagens.push({
                        texto: 'Operação mal sucedida!',
                        tipo: 'error'
                    })
                }
            );
        },
        obter: function() {
            this.$http.get("usuarios.json").then(
                response => {
                    this.usuarios = response.data;
                    console.log(this.usuarios)
                },
                err => {}
            );
        },
        obter2: function() {
            axios.get("https://curso-vue-cod3r-gui.firebaseio.com/usuarios.json").then(
                response => {
                    this.usuarios = response.data;
                },
                err => {}
            );
        }
        // get: function() {
        //     this.$http.post('usuarios.json', {
        //         nome: 'Guilherme',
        //         email: 'gui@email.com'
        //     }).then(res => {
        //         console.log(res);
        //     }, err => {
        //         console.log(err);
        //     });
        // }
    },
    created: function() {}
};
</script>

<style>
#app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
    font-size: 1.5rem;
}

#app h1 {
    text-align: center;
    margin: 50px;
}
</style>
