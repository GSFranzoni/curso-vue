<template>
  <div id="app">
    <h1>Filtros & Mixins (Desafio)</h1>
    <h4>{{ texto | spaceToComma }}</h4>
    <h4>{{ texto | count }}</h4>
    <h4>{{ computedSpaceToComma }}</h4>
    <h4>{{ computedCount }}</h4>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
        texto: 'Testando o novo filtro que criei'
    };
  },
  filters: {
    spaceToComma: function(value) {
      return value.split(" ").join(",");
    }
  },
  computed: {
    computedSpaceToComma: function() {
      //return this.texto.split(" ").join(",");
      return this.texto.replace(/ /g, ',');
    },
    computedCount: function() {
      return this.texto.split(' ').map(v => `${v} (${v.length})`).join(' ');
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
