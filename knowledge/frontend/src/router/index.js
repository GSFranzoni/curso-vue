import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/home/Home.vue'
import AdminPages from '../views/admin/AdminPages.vue'
import ArticlesByCategory from '../views/article/ArticlesByCategory.vue'
import ArticleById from '../views/article/ArticleById.vue'

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
    component: AdminPages
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
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
