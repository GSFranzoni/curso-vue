<template>
    <transition-group name="resize" id="app" :class="{'hide-menu': isMenuVisible}">
        <Header key="header" :hideToggle="false" title="Cod3r - Base de conhecimento"></Header>
        <Menu key="menu" v-if='isMenuVisible'></Menu>
        <Content key="content"></Content>
        <Footer key="footer"></Footer>
    </transition-group>

    <!-- <router-link to="/">Home</router-link> |
        <router-link to="/about">About</router-link>
    <router-view />-->
</template>

<script>
import { mapState } from "vuex";
import Header from "@/components/template/Header";
import Menu from "@/components/template/Menu";
import Content from "@/components/template/Content";
import Footer from "@/components/template/Footer";

export default {
    name: "App",
    components: {
        Header,
        Menu,
        Footer,
        Content
    },
    computed: mapState(["isMenuVisible"])
};
</script>

<style>
body, html {
    height: 100vh;
    margin: 0;
}
#app {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    height: 100vh;

    display: grid;
    grid-template-areas: "menu header" "menu content" "menu footer";
    grid-template-rows: 60px 1fr 40px;
    grid-template-columns: auto 1fr;
}

.resize-enter-active,
.resize-leave-active {
    transition: width 0.3s linear;
}
.resize-enter,
.resize-leave-to {
    width: 0px;
}
.resize-leave,
.resize-enter-to {
    width: 300px;
}
</style>
