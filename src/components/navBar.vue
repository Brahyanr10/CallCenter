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
          <b-nav-item href="/create/user">Registro</b-nav-item>
          <b-nav-item href="#">Disabled</b-nav-item>
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
