<template>
    <div id="app">
        <Header :hideToggle='false' title='Cod3r - Base de conhecimento'></Header>
        <Menu></Menu>
        <Content></Content>
        <Footer></Footer>
        <!-- <router-link to="/">Home</router-link> |
        <router-link to="/about">About</router-link>
        <router-view />-->
    </div>
</template>

<script>
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
    }
};
</script>

<style>
body {
    margin: 0;
}
#app {
    margin: 0;
    padding: 0;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    height: 100vh;

    display: grid;
    grid-template-areas: "menu header" "menu content" "menu footer";
    grid-template-rows: 60px 1fr 40px;
    grid-auto-columns: 300px 1fr;
}
</style>
