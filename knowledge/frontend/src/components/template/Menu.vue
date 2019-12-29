<template>
    <aside class="menu" v-show="isMenuVisible">
        <div class="menu-filter">
            <i class="fa fa-search fa-lg"></i>
            <input 
                type="text" 
                placeholder="Digite para filtrar..."
                v-model="treeFilter"
                class="filter-field">
        </div>
        <Tree :data='treeData' :options='treeOptions' ref='tree' :filter='treeFilter' />
    </aside>
</template>

<script>
import { mapState } from 'vuex'
import Tree from 'liquor-tree';
import { baseApiUrl } from '@/global';
import axios from 'axios';

export default {
    name: "Menu",
    components: { Tree },
    data: function() {
        return {
            treeData: this.getTreeData(),
            treeFilter: '',
            treeOptions: {
                propertyNames: {
                    'text': 'name'
                },
                filter: {
                    emptyText: 'Categoria não encontrada!'
                }
            }
        }
    },
    methods: {
        getTreeData: function() {
            const url = `${baseApiUrl}/categories/tree`;
            return axios.get(url).then(res=>res.data.data);
        },
        onNodeSelect: function(node) {
            this.$router.push({
                name: 'ArticlesByCategory',
                params: { id: node.id }
            })
            if(this.$mq === 'xs' || this.$mq === 'sm') {
                this.$store.commit('toggleMenu', false);
            }
        }
    },
    mounted: function() {
        this.$refs.tree.$on('node:selected', this.onNodeSelect);
    },
    computed: mapState(['isMenuVisible'])
};
</script>

<style>
.menu {
    grid-area: menu;
    background: linear-gradient(to right, #232526, #414345);

    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    width: 300px;
}

.menu a, .menu a:hover {
    color: white;
    text-decoration: none;
}

.menu .tree-node.selected > .tree-content,
.menu .tree-node .tree-content:hover {
    background-color: rgba(255, 255, 255, 0.1)
}

.tree-arrow.has-child {
    filter: brightness(2);
}

.menu .menu-filter {
    max-width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px;
    padding-bottom: 8px;
    border-bottom: 1px solid #AAA;
}

.menu .menu-filter i {
    color: #AAA;
    margin-right: 10px;
}

.menu input {
    width: 100%;
    color: #CCC;
    font-size: 1.3rem;
    border: none;
    outline: 0;
    background: transparent;
}

.tree-filter-empty {
    color: #CCC;
    margin-left: 20px;
}

</style>