<template>
  <div>
    <h1>Contadores</h1>
    <app-contador v-for="n in 5" :key="n"></app-contador>
  </div>
</template>

<script>

import Contador from './Contador.vue';

export default {

    data: function() {
        return {
            
        }
    },
    components: {
        'app-contador': Contador
    }
}
</script>

<style>

</style>