new Vue({
    el: '#desafio',
    data: {
        nome: 'Guilherme S. Franzoni',
        idade: 22,
        src: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1200px-Vue.js_Logo_2.svg.png',

    },
    methods: {
        rand: function() {
            return Math.random();
        }
    }
})