<template>
    <div id="app">
        <div class="grid">
            <app-display></app-display>
            <app-button triple label="AC"></app-button>
            <app-button label="/" operation></app-button>
            <app-button label="7"></app-button>
            <app-button label="8"></app-button>
            <app-button label="9"></app-button>
            <app-button label="*" operation></app-button>
            <app-button label="4"></app-button>
            <app-button label="5"></app-button>
            <app-button label="6"></app-button>
            <app-button label="-" operation></app-button>
            <app-button label="1"></app-button>
            <app-button label="2"></app-button>
            <app-button label="3"></app-button>
            <app-button label="+" operation></app-button>
            <app-button double label="0"></app-button>
            <app-button label="."></app-button>
            <app-button label="=" operation></app-button>
        </div>
    </div>
</template>

<script>
import Display from "./components/Display.vue";
import Button from "./components/Button.vue";

export default {
    name: "app",
    components: {
        "app-display": Display,
        "app-button": Button
    },
    data: function() {
        return {
            result: '0'
        }
    },
    methods: {
        update: function() {
            // eslint-disable-next-line
            console.log('yes');
        }
    }
};
</script>

<style>
@import url("https://fonts.googleapis.com/css?family=Roboto+Mono:100&display=swap");
* {
    font-family: 'Roboto Mono', monospace;
}
#app {
    display: flex;
    flex-direction: row;
    justify-content: center;
}
.grid {
    width: 500px;
    height: auto;
    border: 1px solid black;
    display: grid;
    grid-template-columns: 0.25fr 0.25fr 0.25fr 0.25fr;
}
</style>
