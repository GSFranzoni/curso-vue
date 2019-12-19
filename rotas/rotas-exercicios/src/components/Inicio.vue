<template>
  <div class="inicio">
      <h2>Inicio</h2>
      <hr>
      <button @click='navigateUser' sucesso>Usuário</button>
  </div>
</template>

<script>
export default {
    methods: {
        navigateUser: function() {
            this.$router.push({
                path: '/usuario' 
            })
        }
    }
}
</script>

<style>

</style>