<template>
  <div id="app">
    <h1>Formulário Desafio</h1>
    <div class="conteudo">
      <form class="painel" v-if='!sent'>
        <div class="cabecalho">Formulário</div>
        <NomeCompleto v-model='pessoa.nome'/>
        <Rotulo nome="E-mail">
          <input type="email" v-model="pessoa.email" />
        </Rotulo>
        <Rotulo nome="Senha">
          <input type="password" v-model="pessoa.senha" />
        </Rotulo>
        <Rotulo nome="Armazenar dados">
          <select v-model="pessoa.armazenar">
            <option value="1">Sim</option>
            <option value="0">Não</option>
          </select>
        </Rotulo>
		<button @click.prevent='enviar'>Enviar</button>
      </form>
      <div class="painel" v-else>
        <div class="cabecalho">Resultado</div>
		<Rotulo nome='Nome completo'>
			{{ pessoa.nome }}
		</Rotulo>
		<Rotulo nome='E-mail'>
			{{ pessoa.email }}
		</Rotulo>
		<Rotulo nome='Senha'>
			{{ pessoa.senha }}
		</Rotulo>
		<Rotulo nome='Armazenar dados'>
			{{ pessoa.armazenar }}
		</Rotulo>
      </div>
    </div>
  </div>
</template>

<script>
import Rotulo from "./components/Rotulo.vue";
import NomeCompleto from "./components/NomeCompleto.vue";

export default {
  name: "app",
  components: { Rotulo, NomeCompleto },
  data: function() {
    return {
	  pessoa: {
		  armazenar: 1
	  },
	  sent: false
    };
  },
  methods: {
	  enviar: function() {
		  this.sent = true;
	  }
  }
};
</script>

<style>
body {
  background-color: #ececec;
}

#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;

  display: flex;
  flex-direction: column;
}

.conteudo {
  display: flex;
}

.painel {
  flex: 1;
  background: #fff;
  margin: 0px 10px;
  padding: 20px;
  border: 1px solid #aaa;
  border-radius: 5px;
}

.painel .cabecalho {
  width: 100%;
  background-color: #ddd;
  padding: 10px 0px;
  border-radius: 5px;
  font-size: 1.4rem;
}

#app form button {
  float: right;
  margin: 10px 0px;
  padding: 10px 20px;
  font-size: 1.4rem;
  border-radius: 5px;
  color: #fff;
  background-color: #2196f3;
}

#app h1 {
  font-weight: 200;
  margin: 20px;
  padding: 0;
}

.mr-4 {
  margin-right: 40px;
}
</style>
