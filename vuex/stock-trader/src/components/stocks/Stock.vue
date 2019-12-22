<template>
    <v-flex class="ma-2" xs12 md6 lg4>
        <v-card class="green" light color="#fff">
            <v-card-title class="headLine white--text">{{ stock.name }}</v-card-title>
            <v-card-subtitle
                class="headLine d-flex justify-end white--text"
            >Preço: {{ stock.price | money }}</v-card-subtitle>
        </v-card>
        <v-card>
            <v-container fill-height>
                <v-text-field class="ma-1" v-model="quantity" label="Quantidade" type="number"></v-text-field>
                <v-btn @click="buyStock" class="ma-1" text color="green">Comprar</v-btn>
            </v-container>
        </v-card>
        <transition name='fade'>
            <v-snackbar v-model="snackbar">
                {{ errorMessage }}
                <v-btn color="red" text @click="snackbar = false">Close</v-btn>
            </v-snackbar>
        </transition>
    </v-flex>
</template>

<script>
export default {
    props: ["stock"],
    data: () => {
        return {
            quantity: 0,
            snackbar: false,
            errorMessage: "Erro"
        };
    },
    methods: {
        buyStock: function() {
            try {
                this.$store.dispatch("buyStock", {
                    id: this.stock.id,
                    price: this.stock.price,
                    quantity: this.quantity
                });
                this.quantity = 0;
            } catch (ex) {
                this.errorMessage = ex.message;
                this.snackbar = true;
            }
        }
    }
};
</script>

<style>

</style>