import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/index.vue'
import CreateUser from './views/addUser.vue'
import Listusers from './views/listusers.vue'
import Edituser from './views/edituser.vue'

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
    },
    {
      path: '/listar/user',
      name: 'listusers',
      component: Listusers
    },
    {
      path: '/editar/user',
      name: 'editusers',
      component: Edituser
    }
  ]
})
