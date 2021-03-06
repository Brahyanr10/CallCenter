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
import Listpuesto from './views/listvotacion.vue'
import Eliminarusuario from './views/eliminarusers.vue'
import Deletecomuna from './views/eliminarcomuna.vue'
import Aggbarrio from './views/agregarbarrio.vue'
import Deletebarrio from './views/eliminarbarrio.vue'
import Aggvotacion from './views/agregarvotacion.vue'
import Editvotacion from './views/editvotacion.vue'
import Deletepuesto from './views/eliminarpuesto.vue'
import Aggvotantes from './views/agregarvotantes.vue'
import Listvotantes from './views/listvotantes.vue'
import Editvotantes from './views/editvotantes.vue'
import Deletevotantes from './views/eliminarvotantes.vue'
import Home from './views/home.vue'
import Busqueda from './views/busqueda.vue'
import Busquedabarrio from './views/buscarbarrio.vue'
import Busquepuesto from './views/buscarpuesto.vue'
import Cambiocontra from './views/cambiocontra.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/cambio/contraseña',
      name: 'cambiocontra',
      component: Cambiocontra
    },
    {
      path: '/busquedabarrio',
      name: 'busquedabarrio',
      component: Busquedabarrio
    },
    {
      path: '/busquedapuesto',
      name: 'busquedapuesto',
      component: Busquepuesto
    },
    {
      path: '/busqueda',
      name: 'busqueda',
      component: Busqueda
    },
    {
      path: '/iniciarsesion',
      name: 'iniciarsesion',
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
      path: '/eliminar/user',
      name: 'eliminarusuario',
      component: Eliminarusuario
    },
    {
      path: '/agregar/comuna',
      name: 'aggcomuna',
      component: Aggcomuna
    },
    {
      path: '/eliminar/comuna',
      name: 'deletecomuna',
      component: Deletecomuna
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
    },
    {
      path: '/agregar/barrio',
      name: 'aggbarrio',
      component: Aggbarrio
    },
    {
      path: '/eliminar/barrio',
      name: 'deletebarrio',
      component: Deletebarrio
    },
    {
      path: '/listar/puestovotacion',
      name: 'listvotacion',
      component: Listpuesto
    },
    {
      path: '/agergar/puestovotacion',
      name: 'aggvotacion',
      component: Aggvotacion
    },
    {
      path: '/editar/puestovotacion',
      name: 'editvotacion',
      component: Editvotacion
    },
    {
      path: '/eliminar/puestovotacion',
      name: 'deletepuesto',
      component: Deletepuesto
    },
    {
      path: '/Agregar/Votantes',
      name: 'aggvotantes',
      component: Aggvotantes
    },
    {
      path: '/listar/Votantes',
      name: 'listvotantes',
      component: Listvotantes
    },
    {
      path: '/editar/Votantes',
      name: 'editvotantes',
      component: Editvotantes
    },
    {
      path: '/eliminar/Votantes',
      name: 'deletevotantes',
      component: Deletevotantes
    }
  ]
})
