import Vue from 'vue';

export default new Vue({
    methods: {
        setPerson: function(person) {
            this.$emit('changePerson', person);
        },
        onChange: function(callback) {
            this.$on('changePerson', callback);
        }
    }
})