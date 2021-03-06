import Vue from 'vue';
import Router from 'vue-router';
import Inicio from './components/Inicio';
import Menu from './template/Menu';
import MenuAlt from './template/MenuAlt';
// import Usuario from './components/usuario/Usuario';
// import UsuarioLista from './components/usuario/UsuarioLista';
// import UsuarioDetalhe from './components/usuario/UsuarioDetalhe';
// import UsuarioEditar from './components/usuario/UsuarioEditar';

const Usuario = () => import(/* webpackChunkName: 'usuario' */'./components/usuario/Usuario')
const UsuarioEditar = () => import(/* webpackChunkName: 'usuario' */'./components/usuario/UsuarioEditar')
const UsuarioLista = () => import('./components/usuario/UsuarioLista')
const UsuarioDetalhe = () => import('./components/usuario/UsuarioDetalhe')


Vue.use(Router);

const router = new Router({
    mode: 'history',
    scrollBehavior: function(to, from, savedPosition) {
        if(savedPosition) {
            return savedPosition
        }
        if(to.hash) {
            return {
                selector: to.hash
            }
        }
        return {
            x: 0, y: 0
        }
    },
    routes: [
        { 
            path: '/',
            //component: Inicio,
            name: 'inicio',
            components: {
                default: Inicio,
                menu: Menu
            }
        },
        {
            path: '/usuario',
            //component: Usuario,
            components: {
                default: Usuario,
                menu: MenuAlt
            },
            props: true,
            children: [
                {
                    path: '',
                    component: UsuarioLista
                },
                {
                    path: ':id',
                    component: UsuarioDetalhe,
                    props: true
                },
                {
                    path: ':id/editar',
                    component: UsuarioEditar,
                    props: true,
                    name: 'editar'
                }
            ]
        },
        {
            path: '/redirecionar',
            redirect: '/usuario'
        },
        {
            path: '/*',
            redirect: '/'
        }
    ]
})

// router.beforeEach((to, from, next) => {
//     // eslint-disable-next-line no-console
//     console.log('Antes das rotas - global');
//     if(to.path != '/usuario')
//         next('/usuario');
//     else
//         next()
// })

export default router