<template>
  <div class="usuario">
      <h2>Usuário</h2>
      <hr>
      <router-view></router-view>
      <button @click='navigateBack' sucesso>Voltar</button>
  </div>
</template>

<script>
export default {

    methods: {
        navigateBack: function() {
            // this.$router.push({
            //     path: '/'
            // });
            this.$router.push({
                name: 'inicio'
            });
        }
    }
}
</script>

<style>

</style>