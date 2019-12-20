<template>
    <v-toolbar>
        <v-toolbar-title class='headLine text-uppercase mr-4'>
            <span>Stock</span>
            <span class="font-weight-light">Trader</span>
        </v-toolbar-title>
        <v-toolbar-items>
            <v-btn text to='/'>Início</v-btn>
            <v-btn text to='/portfolio'>Portfólio</v-btn>
            <v-btn text to='/stocks'>Ações</v-btn>
        </v-toolbar-items> 
        <v-spacer></v-spacer>
        <v-toolbar-items>
            <v-btn text>Finalizar dia</v-btn>
            <v-menu offset-y>
                <template v-slot:activator="{ on }">
                <v-btn text v-on="on">Salvar & Carregar</v-btn>
                </template>
                <v-list>
                    <v-list-item>
                        <v-list-item-title>Salvar dados</v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>Carregar dados</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
export default {

}
</script>

<style>
    
</style>