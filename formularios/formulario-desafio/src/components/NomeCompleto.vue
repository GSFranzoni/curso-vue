<template>
  <div id='my-div'>
    <Rotulo style='margin-right: 3px;' nome='Nome'>
        <input v-model='nome' type="text" />
    </Rotulo>
    <Rotulo style='margin-left: 3px;' nome='Sobrenome'>
        <input v-model='sobrenome' type="text" />
    </Rotulo>
  </div>
</template>

<script>

import Rotulo from './Rotulo';

export default {
    data: function() {
        return {
            nome: '',
            sobrenome: ''
        }
    },
    props: {
        value: {
            type: String
        }
    },
    watch: {
        nome: function() {
            this.$emit('input', this.nome + " " + this.sobrenome);
        },
        sobrenome: function() {
            this.$emit('input', this.nome + " " + this.sobrenome);
        }
    },
    components: {Rotulo}
};
</script>

<style>
    #my-div {
        margin-top: 10px;
        width: 100%;
        display: grid;
        grid-template-columns: 0.5fr 0.5fr;
    }
</style>