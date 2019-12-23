<template>
    <div id="app">
        <h1>Monty Hall</h1>
        <button v-if='playing' @click="back" class="btn btn-primary btn-lg w-180 m-2">Voltar</button>
        <transition-group enter-active-class="animated flipInX" mode="out-in">
            <div v-if="!playing" class="my-form" :key='1'>
                <div class="form-group">
                    <label for="doors-quantity">Quantidade de portas</label>
                    <input v-model="doors" class="form-control" type="number" id="doors-quantity" />
                </div>
                <div class="form-group">
                    <label for="door-with-gift">Porta premiada</label>
                    <input
                        v-model="doorWithGift"
                        class="form-control"
                        type="number"
                        id="door-with-gift"
                    />
                </div>
                <button @click="start" class="btn btn-primary btn-lg">Começar</button>
            </div>
            <div v-else class="doors" :key='2'>
                <app-door v-for="n in parseInt(doors)" :label="n" :key="n" :hasGift="n==doorWithGift"></app-door>
            </div>
        </transition-group>            
    </div>
</template>

<script>
import Door from "./components/Door.vue";

export default {
    name: "app",
    data: function() {
        return {
            playing: false,
            doors: 7,
            doorWithGift: 1
        };
    },
    components: {
        "app-door": Door
    },
    methods: {
        start: function() {
            if (this.doors < 3 || this.doors > 15) {
                alert("A quantidade de portas deve estar entre 3 e 15!");
                return;
            }
            if (this.doorWithGift < 1 || this.doorWithGift > this.doors) {
                alert("A porta premiada deve estar entre 1 e " + this.doors);
                return;
            }
            this.playing = true;
        },
        back: function() {
            this.doors = 3;
            this.doorWithGift = 1;
            this.playing=false;
        }
    }
};
</script>

<style>
body {
    background: rgb(238, 174, 202);
    background: radial-gradient(
        circle,
        rgba(238, 174, 202, 1) 0%,
        rgba(148, 187, 233, 1) 100%
    );
    margin: 0;
    padding: 0;
}
.w-180 {
    width: 180px;
}
#app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
.doors {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.my-form {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.my-form > * {
    width: 320px;
    max-width: 90%;
}
label {
    width: 100%;
    text-align: start;
}
</style>
