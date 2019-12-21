<template>
    <v-app>
        <v-content>
            <Header></Header>
            <v-container>
                <transition 
                    enter-active-class="animated flipInX"
                    mode='out-in'>
                    <router-view></router-view>
                </transition>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
import Header from "./components/template/Header";

export default {
    name: "App",
    components: {
        Header
    },
    data: () => ({})
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
    opacity: 0;
}
</style>
