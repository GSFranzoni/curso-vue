<template>
    <v-toolbar>
        <v-toolbar-title class="headLine text-uppercase mr-4">
            <span>Stock</span>
            <span class="font-weight-light">Trader</span>
        </v-toolbar-title>
        <v-toolbar-items>
            <v-btn text to="/">Início</v-btn>
            <v-btn text to="/portfolio">Portfólio</v-btn>
            <v-btn text to="/stocks">Ações</v-btn>
        </v-toolbar-items>
        <v-spacer></v-spacer>
        <v-toolbar-items>
            <v-btn @click='endDay' text>Finalizar dia</v-btn>
            <v-menu offset-y>
                <template v-slot:activator="{ on }">
                    <v-btn text v-on="on">Salvar & Carregar</v-btn>
                </template>
                <v-list>
                    <v-list-item @click='save'>
                        <v-list-item-title>Salvar dados</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click='load'>
                        <v-list-item-title>Carregar dados</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-layout align-center>
                <span class="text-uppercase grey--text text--darken-2">Saldo: {{ funds | money }}</span>
            </v-layout>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
export default {
    computed: {
        funds: function() {
            return this.$store.state.portfolio.funds;
        }
    },
    methods: {
        save: function() {
            this.$store.dispatch('sendData');
        },
        load: function() {
            this.$store.dispatch('loadData');
        },
        endDay: function() {
            this.$store.dispatch('generate');
        }
    }
};
</script>

<style>
</style>