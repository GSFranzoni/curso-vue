<template>
	<div id="app">
		<h1>Filtros & Mixins</h1>
		<hr>
		<p>{{ cpf | inverter | cpf }}</p>
		<input type="text" :value="cpf | inverter | cpf">
		<hr>
		<Frutas/>
		<hr>
		<div>
        <ul>
            <li v-for="fruta in frutas" :key="fruta">
                {{ fruta }}
            </li>
        </ul>
        <input type="text" v-model='fruta' @keydown.enter="add">
    </div>
	</div>
</template>

<script>

import Frutas from './Frutas';
import frutasMixins from './frutasMixins';
import usuarioMixins from './usuarioMixins';

export default {
	mixins: [frutasMixins, usuarioMixins],
	filters: {
		cpf(valor) {
			const arr = valor.split('');
			arr.splice(3, 0, '.');
			arr.splice(7, 0, '.');
			arr.splice(11, 0, '-');
			return arr.join('');
		}
	},
	data: function() {
		return {
			cpf: '14052606612'
		}
	},
	components: {Frutas},
	created() {
        console.log('created app');
    }
}
</script>

<style>
#app {
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	text-align: center;
	color: #2c3e50;
	margin-top: 60px;
	font-size: 2.5rem;
}

input {
	font-size: 1.5rem;
}
</style>
