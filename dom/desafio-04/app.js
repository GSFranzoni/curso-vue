new Vue({
	el: '#desafio',
	data: {
		iniciar: false,
		aplicarDestaque: false,
		cls3: '',
		cls4: '',
		vermelho: false,
		estiloQuadrado: {
			width: 50,
			height: 50
		},
		cor: '',
		progresso: 0,
		progressoInit: false
	},
	computed: {

	},
	methods: {
		iniciarEfeito() {
			this.iniciar = true;
			setInterval(() => {
				this.aplicarDestaque = !this.aplicarDestaque;
			}, 2000);
		},
		iniciarProgresso() {
			setInterval(() => {
				this.progresso += 1;
				this.progresso %= 100;
			}, 100)
		},
		aplicarVermelho(evt) {
			this.vermelho = evt.target.value === "true" ? true : false;
		}
	}
})
