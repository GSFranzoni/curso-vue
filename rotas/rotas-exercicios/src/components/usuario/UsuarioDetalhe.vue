<template>
  <div class="usuario-detalhe">
      <h3>Usuário detalhe</h3>
      <p><strong>Código: </strong>{{ id }}</p>
      <router-link :to="{ 
            name:'editar', 
            params: { id },
            query: { completo: true, lingua: 'pt', hash:'#rodape' }
        }" tag='button' primario>Editar</router-link>
  </div>
</template>

<script>
export default {
    props: ['id'],
    beforeRouteEnter(from, to, next) {
        console.log('Dentro do componente -> usuário detalhe')
        // next(vm => {
        //     console.log(vm.id)
        // })
        const autenticado = true
        autenticado? next(): next(false)
    }
}
</script>

<style>

</style>