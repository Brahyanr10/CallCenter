import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/index.vue'
import CreateUser from './views/addUser.vue'
import Listusers from './views/listusers.vue'
import Edituser from './views/edituser.vue'
import Aggcomuna from './views/agregarcomuna.vue'
import Listcomuna from './views/listcomuna.vue'
import Editcomuna from './views/editcomuna.vue'
import Listbarrio from './views/listbarrios.vue'
import Editbarrio from './views/editbarrio.vue'

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
    },
    {
      path: '/agergar/comuna',
      name: 'aggcomuna',
      component: Aggcomuna
    },
    {
      path: '/listar/comuna',
      name: 'listcomuna',
      component: Listcomuna
    },
    {
      path: '/editar/comuna',
      name: 'editcomuna',
      component: Editcomuna
    },
    {
      path: '/listar/barrio',
      name: 'listbarrio',
      component: Listbarrio
    },
    {
      path: '/editar/barrio',
      name: 'editbarrio',
      component: Editbarrio
    }
  ]
})
