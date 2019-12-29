<template>
    <div id="app" :class="{'hide-menu': !isMenuVisible || !user }">
        <Header :hideToggle="!user" title="Cod3r - Base de conhecimento" :hideUserdropdown="!user"></Header>
        <Menu v-if="user"></Menu>
        <Loading v-if="validating"></Loading>
        <Content v-else></Content>
        <Footer></Footer>
    </div>
</template>

<script>
import axios from "axios";
import { baseApiUrl, userKey } from "@/global";
import { mapState } from "vuex";
import Header from "@/components/template/Header";
import Menu from "@/components/template/Menu";
import Content from "@/components/template/Content";
import Footer from "@/components/template/Footer";
import Loading from "@/components/template/Loading";

export default {
    name: "App",
    data: function() {
        return {
            validating: true
        };
    },
    components: {
        Header,
        Menu,
        Footer,
        Content,
        Loading
    },
    computed: mapState(["isMenuVisible", "user"]),
    methods: {
        validateToken: async function() {
            this.validating = true;

            const json = localStorage.getItem(userKey);
            const userData = JSON.parse(json);
            this.$store.commit("setUser", null);

            if (!userData) {
                this.validating = false;
                this.$router.push({
                    name: "Auth"
                });
                return;
            }

            await axios
                .post(`${baseApiUrl}/validate`, userData)
                .then(() => {
                    this.$store.commit("setUser", userData);
                })
                .catch(() => {
                    localStorage.removeItem(userKey);
                    this.$router.push({
                        name: "Auth"
                    });
                });

            this.validating = false;
        }
    },
    created: function() {
        this.validateToken();
        if (this.$mq === "xs" || this.$mq === "sm") {
            this.$store.commit("toggleMenu", true);
        }
    }
};
</script>

<style>
body,
html {
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
    grid-template-columns: 300px 1fr;
}

#app.hide-menu {
    display: grid;
    grid-template-areas: "header" "content" "footer";
    grid-template-rows: 60px 1fr 40px;
    grid-template-columns: 1fr;
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
