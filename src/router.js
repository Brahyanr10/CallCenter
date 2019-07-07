import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/index.vue'
import CreateUser from './views/addUser.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'index',
      component: Index
    },
    {
      path: '/create/user',
      name: 'addUser',
      component: CreateUser
    }
  ]
})
