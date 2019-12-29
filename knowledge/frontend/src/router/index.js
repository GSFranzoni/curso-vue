import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/home/Home.vue'
import AdminPages from '../views/admin/AdminPages.vue'
import ArticlesByCategory from '../views/article/ArticlesByCategory.vue'
import ArticleById from '../views/article/ArticleById.vue'
import Auth from '../views/auth/Auth.vue'
import { userKey } from '../global'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/admin',
        name: 'adminPages',
        component: AdminPages,
        meta: { requiresAdmin: true }
    },
    {
        path: '/categories/:id/articles',
        name: 'ArticlesByCategory',
        component: ArticlesByCategory
    },
    {
        path: '/articles/:id',
        name: 'ArticleById',
        component: ArticleById
    },
    {
        path: '/auth',
        name: 'Auth',
        component: Auth
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach((to, from, next) => {
    const json = localStorage.getItem(userKey);

    if(to.matched.some(record => record.meta.requiresAdmin)) {
        const user = JSON.parse(json);
        
        if(user && user.admin && user.admin!="0") {
            next();
        }
        else {
            next({
                path: '/'
            })
        }
    }
    else {
        next();
    }
})

export default router
