<template>
    <v-app>
        <v-content>
            <Header></Header>
            <v-container>
                <router-view></router-view>
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
</style>
