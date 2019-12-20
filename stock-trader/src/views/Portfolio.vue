<template>
  <v-layout row wrap>
      <app-stock v-for='order in orders' :order='order' :key=order.id></app-stock>
  </v-layout>
</template>

<script>
import Stock from "../components/portfolio/Stock";
import { mapGetters } from 'vuex';

export default {
    name: 'portfolio',
    components: {
        'app-stock': Stock
    },
    computed: {
        ...mapGetters({
            orders: 'getOrders'
        })
    }
}
</script>

<style scoped>

</style>