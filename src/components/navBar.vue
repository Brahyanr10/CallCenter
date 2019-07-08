<template>
  <div id="app">
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand class="Logo" :to="{ name: 'index' }">
        <span class="icon-Logo">CallCenter</span>
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto" right>
          <b-nav-item :to="{name: 'addUser'}">Nuevo Usuario</b-nav-item>
          <b-nav-item :to="{name: 'listusers'}">Lista De Usuarios</b-nav-item>

          <b-nav-item-dropdown text="comuna" right>
            <b-dropdown-item :to="{name: 'listcomuna'}">Listado De comunas</b-dropdown-item>
            <b-dropdown-item :to="{name: 'aggcomuna'}">Agregar Comuna</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown text="Barrio" right>
            <b-dropdown-item :to="{name: 'listbarrio'}">Listado De Barrios</b-dropdown-item>
            <b-dropdown-item :to="{name: 'aggbarrio'}">Agregar Barrio</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown text="Puestos De Votacion" right>
            <b-dropdown-item :to="{name: 'listvotacion'}">Listado Puestos De Votacion</b-dropdown-item>
            <b-dropdown-item :to="{name: ''}">Agregar Puestos De Votacion</b-dropdown-item>
          </b-nav-item-dropdown>

        </b-navbar-nav>
        <b-navbar-nav class="ml-auto">
          <v-btn
            outline
            color="#009688"
            :to="{ name: 'Login' }"
            v-if="!mostrar"
          >
            Iniciar Sesión
          </v-btn>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div></template
>

<script>
export default {};
</script>

<style lang="css" scoped></style>
