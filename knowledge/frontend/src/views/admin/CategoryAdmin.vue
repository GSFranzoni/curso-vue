<template>
    <div class="category-admin">
        <input type="hidden" v-model.number="category.id" />
        <b-form-group label-for="category-name" label="Nome">
            <b-form-input id="category-name" type="text" v-model="category.name"></b-form-input>
        </b-form-group>
        <b-form-group label-for="category-parent" label="Categoria pai">
            <b-form-select v-model.number="category.parent" :options="options"></b-form-select>
        </b-form-group>
        <b-button @click="save" variant="primary" v-show="mode === 'save'">Salvar</b-button>
        <b-button @click="remove" variant="danger" v-show="mode === 'remove'">Excluir</b-button>
        <b-button class="ml-2" @click="reset" variant="secondary">Cancelar</b-button>
        <b-table class="mt-3" :fields="fields" :items="categories">
            <template v-slot:cell(parent)="data">{{ getCategoryName(data.item.parent) }}</template>
            <template v-slot:cell(actions)="data">
                <b-button @click="loadCategory(data.item)" variant="warning">
                    <i class="fa fa-pencil"></i>
                </b-button>
                <b-button @click="loadCategory(data.item, 'remove')" class="ml-2" variant="danger">
                    <i class="fa fa-trash"></i>
                </b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
import axios from "axios";
import { showError, showSuccess, baseApiUrl } from "@/global";

export default {
    name: "CategoryAdmin",
    data: function() {
        return {
            category: {
                parent: null
            },
            categories: [],
            mode: "save",
            fields: [
                { key: "id", sortable: true, label: "Código" },
                { key: "name", sortable: true, label: "Nome" },
                { key: "parent", sortable: true, label: "Pai" },
                { key: "path", sortable: true, label: "Caminho" },
                { key: "actions", label: "Ações" }
            ],
            options: [
                { value: null, text: 'Sem categoria pai' }
            ]
        };
    },
    methods: {
        save: function() {
            const method = this.category.id ? "put" : "post";
            const id = this.category.id ? `/${this.category.id}` : "";
            delete this.category.path;
            axios[method](`${baseApiUrl}/categories${id}`, this.category)
                .then(response => {
                    showSuccess(response.data.message)
                    this.reset();
                })
                .catch(e => {
                    showError(e.response.data.message);
                });
        },
        remove: function() {
            axios
                .delete(`${baseApiUrl}/categories/${this.category.id}`)
                .then(response => {
                    showSuccess(response.data.message)
                    this.reset();
                })
                .catch(e => {
                    showError(e.response.data.message);
                });
        },
        reset: function() {
            this.category = {
                parent: null
            };
            this.options = [
                { value: null, text: 'Sem categoria pai' }
            ];
            this.loadCategories();
            this.mode = "save";
        },
        loadCategories: function() {
            axios
                .get(`${baseApiUrl}/categories`)
                .then(response => {
                    this.categories = response.data.data;
                    this.categories.forEach(element => {
                        this.options.push({ value: element.id, text: element.path })
                    })
                })
                .catch(e => {
                    showError(e.response.data.message);
                });
        },
        getCategoryName: function(id) {
            const parent = this.categories.filter(cat => cat.id === id);
            return parent.length > 0 ? parent[0].name : "-";
        },
        loadCategory: function(category, mode = "save") {
            this.category = { ...category };
            this.mode = mode;
        }
    },
    mounted: function() {
        this.loadCategories();
    }
};
</script>

<style>
</style>