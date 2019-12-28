<template>
    <div class="article-admin">
        <input type="hidden" v-model.number="article.id" />
        <b-form-group label-for="article-name" label="Nome">
            <b-form-input id="article-name" type="text" v-model="article.name"></b-form-input>
        </b-form-group>
        <b-form-group label-for="article-description" label="Descrição">
            <b-form-input id="article-description" type="text" v-model="article.description"></b-form-input>
        </b-form-group>
        <b-form-group label-for="article-image" label="Imagem">
            <b-form-input id="article-image" type="text" v-model="article.image"></b-form-input>
        </b-form-group>
        <b-form-group label-for="article-category" label="Categoria">
            <b-form-select v-model="article.category" :options="categories"></b-form-select>
        </b-form-group>
        <b-form-group label-for="article-user" label="Autor">
            <b-form-select v-model="article.user" :options="users"></b-form-select>
        </b-form-group>
        <b-form-group label-for="article-content" label="Conteúdo">
            <VueEditor v-model='article.content' placeholder="Informe o conteúdo do artigo..."/>
        </b-form-group>
        <b-button @click="save" variant="primary" v-show="mode === 'save'">Salvar</b-button>
        <b-button @click="remove" variant="danger" v-show="mode === 'remove'">Excluir</b-button>
        <b-button class="ml-2" @click="reset" variant="secondary">Cancelar</b-button>
        <b-table class="mt-3" :fields="fields" :items="articles">
            <template v-slot:cell(actions)="data">
                <b-button @click="loadArticle(data.item)" variant="warning">
                    <i class="fa fa-pencil"></i>
                </b-button>
                <b-button @click="loadArticle(data.item, 'remove')" class="ml-2" variant="danger">
                    <i class="fa fa-trash"></i>
                </b-button>
            </template>
        </b-table>
        <b-pagination 
            :total-rows='count' 
            :per-page='limit' 
            size='md' 
            v-model='page'>

        </b-pagination>
    </div>
</template>

<script>
import axios from "axios";
import { showError, showSuccess, baseApiUrl } from "@/global";
import { VueEditor } from 'vue2-editor';

export default {
    name: "ArticleAdmin",
    components: {
        VueEditor
    },
    data: function() {
        return {
            article: {},
            articles: [],
            mode: "save",
            page: 1,
            limit: 0,
            count: 0,
            fields: [
                { key: "id", sortable: true, label: "Código" },
                { key: "name", sortable: true, label: "Nome" },
                { key: "description", sortable: true, label: "Descrição" },
                { key: "actions", label: "Ações" }
            ],
            users: [],
            categories: []
        };
    },
    watch: {
        page: function() {
            this.loadArticles();
        }
    },
    methods: {
        save: function() {
            const method = this.article.id ? "put" : "post";
            const id = this.article.id ? `/${this.article.id}` : "";
            axios[method](`${baseApiUrl}/articles${id}`, this.article)
                .then(response => {
                    if(response.data.status === 200) {
                        showSuccess(response.data.message)
                        this.reset();
                    }
                    else {
                        showError(response.data.message);
                    }
                })
                .catch(e => {
                    showError("Erro" + e);
                });
        },
        remove: function() {
            axios
                .delete(`${baseApiUrl}/articles/${this.article.id}`)
                .then(response => {
                    if(response.data.status === 200) {
                        showSuccess(response.data.message)
                        this.reset();
                    }
                    else {
                        showError(response.data.message);
                    }
                })
                .catch(e => {
                    showError(e);
                });
        },
        reset: function() {
            this.article = {};
            this.categories = [];
            this.users = [];
            this.loadArticles();
            this.mode = "save";
            this.loadCategories();
            this.loadUsers();
        },
        loadArticles: function() {
            axios
                .get(`${baseApiUrl}/articles?page=${this.page}`)
                .then(response => {
                    this.articles = response.data.data.articles;
                    this.limit = response.data.data.limit;
                    this.count = response.data.data.count;
                })
                .catch(e => {
                    showError(e);
                });
        },
        loadCategories: function() {
            axios
                .get(`${baseApiUrl}/categories`)
                .then(response => {
                    this.categories = response.data.data.map(
                        res => {
                            return { value: res.id, text: res.name }
                        }
                    );
                })
                .catch(e => {
                    showError(e);
                });
        },
        loadUsers: function() {
            axios
                .get(`${baseApiUrl}/users`)
                .then(response => {
                    this.users = response.data.data.map(
                        res => {
                            return { value: res.id, text: res.name + " / " + res.email }
                        }
                    );
                })
                .catch(e => {
                    showError(e);
                });
        },
        loadArticle: function(article, mode = "save") {
            this.article = { ...article };
            this.mode = mode;
        }
    },
    mounted: function() {
        this.loadArticles();
        this.loadCategories();
        this.loadUsers();
    }
};
</script>

<style>
</style>