<template>
  <header class="header">
      <a class="toggle" @click='toggleMenu' v-if='!hideToggle' :class="{iconToLeft, iconToRight}">
          <i class="fa fa-lg fa-angle-left"></i>
      </a>
      <h1 class="title">
          <router-link tag='a' to="/">{{ title }}</router-link>
      </h1>
      <UserDropdown v-if='!hideUserdropdown' />
  </header>
</template>

<script>
import UserDropdown from './UserDropdown';

export default {
    name: 'Header',
    props: {
        title: String,
        hideToggle: Boolean,
        hideUserdropdown: Boolean
    },
    components: {
        UserDropdown
    },
    computed: {
        iconToLeft() {
            return this.$store.state.isMenuVisible;
        },
        iconToRight() {
            return !this.iconToLeft;
        }
    },
    methods: {
        toggleMenu() {
            this.$store.commit('toggleMenu');
        }
    }
}
</script>

<style>
    .header {
        grid-area: header;
        background: linear-gradient(to right, #1e469a, #49a7c1);

        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .iconToLeft {
        transform: rotateZ(0deg);
        transition: transform .8s ease;
    }

    .iconToRight {
        transform: rotateZ(180deg);
        transition: transform .8s ease;
    }

    .title {
        font-size: 1.2rem;
        color: white;
        text-align: center;
        font-weight: 100;
        flex-grow: 1;
    }

    .title a {
        color: #FFF;
        text-decoration: none;
        cursor: pointer;
    }

    header.header > a.toggle {
        cursor: pointer;
        width: 60px;
        height: 100%;
        color: #FFF;
        justify-self: flex-start;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    header.header > a.toggle:hover {
        background-color: rgba(1, 1, 1, .2)
    }

</style>