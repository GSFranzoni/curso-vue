<template>
    <div class="home">
        <PageTitle icon="fa fa-home" main="Dashboard" sub="Base de conhecimento" />
        <div class="stats">
            <Stat 
                title="Categorias" 
                :value="stats.categories"
                icon='fa fa-folder'
                color='#d54d50'
            />
            <Stat 
                title="Artigos" 
                :value="stats.articles"
                icon='fa fa-file'
                color='#3bc480'
            />
            <Stat 
                title="Usuários" 
                :value="stats.users"
                icon='fa fa-user'
                color='#3282cd'
            />
        </div>
    </div>
</template>

<script>
import PageTitle from "@/components/template/PageTitle";
import Stat from "./Stat";
import axios from "axios";
import { baseApiUrl } from "@/global";

export default {
    name: "Home",
    components: { PageTitle, Stat },
    data: function() {
        return {
            stats: {}
        };
    },
    methods: {
        getStats: function() {
            axios.get(baseApiUrl + '/stats').then(
                res => {
                    this.stats = res.data.data;
                },
                err => {
                    alert(err);
                }
            )
        } 
    },
    mounted: function() {
        this.getStats();
    }
};
</script>
<style>
    .stats {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
</style>