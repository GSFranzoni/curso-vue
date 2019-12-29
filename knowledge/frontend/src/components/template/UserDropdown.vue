<template>
    <div class="user-dropdown">
        <div class="user-dropdown-button">
            <span class="d-nono d-sm-block">
                {{ user.name }}
            </span>
            <div class="user-dropdown-avatar">
                <Gravatar :email="user.email" />
            </div>
            <i class="fa fa-angle-down"></i>
        </div>
        <div class="user-dropdown-content">
            <router-link v-if='user.admin && user.admin!="0"' to='/admin'><i class="fa fa-cogs"></i>Admistração</router-link>
            <a @click="logout" ><i class="fa fa-sign-out"></i>Sair</a>
        </div>
    </div>
</template>

<script>
import { userKey } from '@/global';
import { mapState } from 'vuex';
import Gravatar from 'vue-gravatar';

export default {
    name: 'UserDropdown',
    components: { Gravatar },
    computed: mapState(['user']),
    methods: {
        logout: function() {
            localStorage.removeItem(userKey);
            this.$store.commit('setUser', null);
            this.$router.push({
                name: 'Auth'
            })
        }
    }
}
</script>

<style>
    .user-dropdown {
        position: relative;
        height: 100%;
    }

    .user-dropdown:hover > .user-dropdown-content {
        opacity: 1;
        visibility: visible;
    }

    .user-dropdown-button {
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        color: white;
        padding: 0px 20px;
        width: 180px;
    }

    .user-dropdown-button:hover {
        background-color: rgba(1, 1, 1, 0.2);
    }

    .user-dropdown-avatar {
        margin: 0px 10px;
    }

    .user-dropdown-avatar > img {
        max-height: 37px;
        border-radius: 5px;
    }

    .user-dropdown-content {
        width: auto;
        z-index: 1;
        position: absolute;
        display: flex;
        flex-direction: column;
        background-color: #fff;
        right: 0;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s, visibility 0.5s linear;
    }

    .user-dropdown-content > a {
        cursor: pointer;
        text-decoration: none;
        color: black;
        padding: 15px 25px;
    }

    .user-dropdown-content > a > i {
        margin-right: 10px;
    }

    .user-dropdown-content > a:hover {
        background-color: rgba(1, 1, 1, 0.2);
    }
</style>