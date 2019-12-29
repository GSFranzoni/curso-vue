<template>
    <div class="user-admin">
        <b-form>
            <input type="hidden" id="user-id" v-model="user.id" />
            <b-row>
                <b-col md="6" sm="12">
                    <b-form-group label="Nome" label-for="user-name">
                        <b-form-input
                            id="user-name"
                            type="text"
                            v-model="user.name"
                            required
                            :readonly='mode === "remove"'
                            placeholder="Informe o nome do usuário"
                        ></b-form-input>
                    </b-form-group>
                </b-col>
                <b-col md="6" sm="12">
                    <b-form-group label="E-mail" label-for="user-email">
                        <b-form-input
                            id="user-email"
                            type="email"
                            v-model="user.email"
                            required
                            :readonly='mode === "remove"'
                            placeholder="Informe o e-mail do usuário"
                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-form-checkbox 
                class="mt-2 mb-4" 
                id="user-admin" 
                :disabled="mode === 'remove'"
                v-model="user.admin">
                    Administrador
            </b-form-checkbox>
            <b-row v-show='mode != "remove"'>
                <b-col md="6" sm="12">
                    <b-form-group label="Senha" label-for="user-password">
                        <b-form-input
                            id="user-password"
                            type="password"
                            v-model="user.password"
                            required
                            placeholder="Informe a senha do usuário"
                        ></b-form-input>
                    </b-form-group>
                </b-col>
                <b-col md="6" sm="12">
                    <b-form-group label="Confirmação de senha" label-for="user-confirm-password">
                        <b-form-input
                            id="user-confirm-password"
                            type="password"
                            v-model="user.confirmPassword"
                            required
                            placeholder="Confirme a senha do usuário"
                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-button variant="primary" v-if='mode==="save"' @click="save">Salvar</b-button>
            <b-button variant="danger" v-if='mode==="remove"' @click="remove">Excluir</b-button>
            <b-button class="ml-2" @click="reset">Cancelar</b-button>
        </b-form>
        <hr />
        <b-table hover striped :items="users" :fields="fields">
            <template v-slot:cell(actions)="data">
                <b-button variant="warning" @click="loadUser(data.item)" class="mr-2">
                    <i class="fa fa-pencil"></i>
                </b-button>
                <b-button variant="danger" @click='loadUser(data.item, "remove")'>
                    <i class="fa fa-trash"></i>
                </b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
import { baseApiUrl, showError, showSuccess } from "@/global.js";
import axios from "axios";

export default {
    name: "UserAdmin",
    data: function() {
        return {
            mode: "save",
            user: {},
            users: [],
            fields: [
                {
                    key: "id",
                    label: "Código",
                    sortable: true
                },
                {
                    key: "name",
                    label: "Nome",
                    sortable: true
                },
                {
                    key: "email",
                    label: "E-mail",
                    sortable: true
                },
                {
                    key: "admin",
                    label: "Administrador",
                    sortable: true,
                    formater: value => (value ? "Sim" : "Não")
                },
                {
                    key: "actions",
                    label: "Ações"
                }
            ]
        };
    },
    methods: {
        loadUser(user, mode = "save") {
            this.mode = mode;
            this.user = { ...user };
        },
        loadUsers: function() {
            axios.get(baseApiUrl + "/users").then(res => {
                this.users = res.data.data;
            });
        },
        save: function() {
            const method = this.user.id ? "put" : "post";
            const id = this.user.id ? `/${this.user.id}` : "";
            axios[method](`${baseApiUrl}/users${id}`, this.user)
                .then(response => {
                    showSuccess(response.data.message)
                    this.reset();
                })
                .catch(e => {
                    showError(e.response.data.message);
                });
        },
        remove: function() {
            const id = this.user.id;
            axios
                .delete(`${baseApiUrl}/users/${id}`)
                .then(response => {
                    showSuccess(response.data.message)
                    this.reset();
                })
                .catch(e => {
                    showError(e.response.data.message);
                });
        },
        reset: function() {
            this.user = {};
            this.mode = "save";
            this.loadUsers();
        }
    },
    mounted: function() {
        this.loadUsers();
    }
};
</script>

<style>
</style>