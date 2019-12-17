import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false

Vue.directive('destaque', {
	bind(el, bindind, vnode) {
		vnode;
		let atraso = 0;
		if(bindind.modifiers['atrasar'])
			atraso = 3000
		setTimeout(() => {
			if(bindind.arg === 'fundo')
			el.style.backgroundColor = bindind.value;
		else
			el.style.color = bindind.value;
		}, atraso)
		
	}
});

new Vue({
	render: h => h(App),
}).$mount('#app')
