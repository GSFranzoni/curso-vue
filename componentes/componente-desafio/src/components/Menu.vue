<template>
  <v-navigation-drawer app>
    <menu-toolbar></menu-toolbar>
    <v-divider></v-divider>
    <menu-list></menu-list>
  </v-navigation-drawer>
</template>

<script>
import MenuToolbar from "./MenuToolbar";
import MenuList from "./MenuList";

export default {
  components: {
    "menu-toolbar": MenuToolbar,
    "menu-list": MenuList
  }
};
</script>

<style>
</style>