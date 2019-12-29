<template>
    <div class="auth-content">
        <div class="auth-modal">
            <img src="@/assets/logo.png" width='200' alt="logo">
            <hr>
            <div class="auth-title">
                {{ showSignup? 'Cadastro': 'Login' }}
            </div>
            <input 
                v-if='showSignup' 
                v-model='user.name'
                placeholder="Nome">
            <input 
                type="email"
                v-model='user.email'
                placeholder="E-mail">
            <input 
                type='password'
                v-model='user.password'
                placeholder="Senha">
            <input 
                type='password'
                v-if='showSignup' 
                v-model='user.confirmPassword'
                placeholder="Confirme a senha">
            
            <a href @click.prevent="showSignup = !showSignup">
                <span> {{ showSignup? 'Já tem cadastro?': 'Não tem cadastro?' }} </span>
            </a>

            <button v-if='showSignup' @click='signup'>Registrar</button>
            <button v-else @click='signin'>Entrar</button>
            
        </div>
    </div>
</template>

<script>
import { baseApiUrl, showError, showSuccess, userKey } from '@/global'
import axios from 'axios'

export default {
    name: 'Auth',
    data: function() {
        return {
            showSignup: false,
            user: {}
        }
    },
    methods: {
        signin: function() {
            axios.post(`${baseApiUrl}/signin`, this.user).then(
                response => {
                    this.$store.commit('setUser', { ...response.data.data.user, token: response.data.data.token });
                    localStorage.setItem(userKey, JSON.stringify({ 
                        ...response.data.data.user, 
                        token: response.data.data.token
                    }));
                    this.$router.push({
                        path: '/'
                    })
                }
            ).catch(e=>{
                showError(e.response.data.message);
            })
        },
        signup: function() {
            axios.post(`${baseApiUrl}/users`, this.user).then(
                response => {
                    showSuccess(response.data.message)
                    this.user = {}
                    this.showSignup = false;
                }
            ).catch(e=>{
                showError(e.response.data.message);
            })
        },
    }
}
</script>

<style>
    .auth-content {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .auth-modal {
        background-color: #FFF;
        width: 350px;
        padding: 35px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);

        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .auth-title {
        font-size: 1.2rem;
        font-weight: 100;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .auth-modal input {
        border: 1px solid #BBB;
        width: 100%;
        margin-bottom: 15px;
        padding: 5px 8px;
        outline: none;
    }

    .auth-modal button {
        align-self: flex-end;
        background-color: #2460ae;
        color: #FFF;
        padding: 5px 15px;
    }

    .auth-modal a {
        align-self: flex-end;
        margin-bottom: 10px;
        text-decoration: none;
    }

    .auth-modal hr {
        border: 0;
        width: 100%;
        height: 1px;
        background-image: linear-gradient(to right, 
            rgba(120, 120, 120, 0),
            rgba(120, 120, 120, 0.75),
            rgba(120, 120, 120, 0)
        )
    }
</style>