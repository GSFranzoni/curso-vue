<template>
    <v-layout class='d-flex justify-center flex-wrap'>
        <app-stock v-for='stock in stocks' :key='stock.id' :stock='stock'></app-stock>
    </v-layout>
</template>

<script>
import Stock from "../components/stocks/Stock";

export default {
    name: "stocks",
    components: {
        "app-stock": Stock
    },
    computed: {
        stocks() {
            return this.$store.state.stocks.stocks;
        }
    }
};
</script>

<style>
</style>