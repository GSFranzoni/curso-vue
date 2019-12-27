<template>
  <div id="app">
    <h1>Diretivas</h1>
    <hr />
    <p v-text="'Usando diretiva v-text'"></p>
    <p v-html="'Usando diretiva <strong>v-html</strong>'"></p>
    <hr />
    <p v-destaque-local:fundo="'lightblue'">Usando diretiva personalizada</p>
    <p v-destaque-local.atrasar="{cor1: 'green', cor2: 'red', atraso: 2000, intervalo: 200}">Usando diretiva personalizada</p>
  </div>
</template>

<script>
export default {
  directives: {
    "destaque-local": {
      bind(el, bindind, vnode) {
        const aplicarCor = cor => {
          if (bindind.arg === "fundo") el.style.backgroundColor = cor;
          else el.style.color = cor;
        };

        let cor1 = bindind.value.cor1;
        let cor2 = bindind.value.cor2;
        let corAtual = cor1;
        let atraso = 0;
        if (bindind.modifiers["atrasar"]) atraso = bindind.value.atraso;

        setTimeout(() => {
          if (bindind.modifiers["alternar"]) {
            setInterval(() => {
              corAtual = corAtual == cor1 ? cor2 : cor1;
              aplicarCor(corAtual);
            }, bindind.value.intervalo);
          } else {
            aplicarCor(cor1);
          }
        }, atraso);
      }
    }
  }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  font-size: 2.5rem;
}
</style>
