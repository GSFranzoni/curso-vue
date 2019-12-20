<template>
    <v-flex class="ma-2" xs12 md6 lg4>
        <v-card class="primary" light color="#fff">
            <v-card-title class="headLine white--text">{{ order.name }}</v-card-title>
            <v-card-subtitle
                class="headLine d-flex justify-end white--text"
            >Preço: {{ order.price | money }} | Qtde: {{ order.quantity }}</v-card-subtitle>
        </v-card>
        <v-card>
            <v-container fill-height>
                <v-text-field class="ma-1" v-model="quantity" label="Quantidade" type="number"></v-text-field>
                <v-btn @click="sellStock" class="ma-1" text color="primary">Vender</v-btn>
            </v-container>
        </v-card>
    </v-flex>
</template>

<script>
export default {
    props: ["order"],
    data: () => {
        return {
            quantity: 0
        };
    },
    methods: {
        sellStock: function() {
            try {
                this.$store.dispatch("sellStock", {
                    order: this.order,
                    quantity: this.quantity
                });
            } 
            catch (ex) {
                alert(ex.message);
            }
        }
    }
};
</script>

<style .scoped>
</style>