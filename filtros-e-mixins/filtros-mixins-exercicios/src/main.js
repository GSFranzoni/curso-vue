import Vue from 'vue'
import App from './App.vue'

Vue.filter('inverter', (valor) => {
	return valor.split('').reverse().join('');
})

Vue.mixin({
	created() {
		// eslint-disable-next-line no-console
		console.log('created global');
	}
})

Vue.config.productionTip = false

new Vue({
	render: h => h(App)
}).$mount('#app')
