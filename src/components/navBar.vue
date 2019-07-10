<template>
  <div id="app">
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand :to="{ name: 'home' }">
        CallCenter
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav v-if="mostrar" class="ml-auto" right>
          <b-nav-item v-if="mostrar2" :to="{ name: 'addUser' }"
            >Nuevo Usuario</b-nav-item
          >
          <b-nav-item v-if="mostrar2" :to="{ name: 'listusers' }"
            >Lista De Usuarios</b-nav-item
          >

          <b-nav-item-dropdown text="Comuna" right>
            <b-dropdown-item :to="{ name: 'listcomuna' }"
              >Listado De comunas</b-dropdown-item
            >
            <b-dropdown-item :to="{ name: 'aggcomuna' }"
              >Agregar Comuna</b-dropdown-item
            >
          </b-nav-item-dropdown>

          <b-nav-item-dropdown text="Barrio" right>
            <b-dropdown-item :to="{ name: 'listbarrio' }"
              >Listado De Barrios</b-dropdown-item
            >
            <b-dropdown-item :to="{ name: 'aggbarrio' }"
              >Agregar Barrio</b-dropdown-item
            >
          </b-nav-item-dropdown>

          <b-nav-item-dropdown text="Puestos De Votacion" right>
            <b-dropdown-item :to="{ name: 'listvotacion' }"
              >Listado Puestos De Votacion</b-dropdown-item
            >
            <b-dropdown-item :to="{ name: 'aggvotacion' }"
              >Agregar Puestos De Votacion</b-dropdown-item
            >
          </b-nav-item-dropdown>
          <b-nav-item :to="{ name: 'listvotantes' }"
            >Listado De Votantes</b-nav-item
          >
          <b-nav-item :to="{ name: 'aggvotantes' }">Agregar Votante</b-nav-item>
        </b-navbar-nav>
        <b-navbar-nav class="ml-auto">
          <v-btn
            @click="iniciarsesion()"
            outline
            color="#009688"
            :to="{ name: 'index' }"
            v-if="!mostrar"
          >
            Iniciar Sesión
          </v-btn>
        <b-nav-item-dropdown v-if="mostrar" right>
          <template slot="button-content" class="glyphicon glyphicon-user"
            ><span id="navItems">{{ usuario[0].nombre }}</span>
          </template>
          <b-dropdown-item :to="{name:'cambiocontra'}">Cambiar Contraseña</b-dropdown-item>
          <b-dropdown-item @click="cerrarsesion()"
            >Cerrar Sesion</b-dropdown-item
          >
          <!-- <span class="glyphicon glyphicon-user"></span> {{this.students[0].nombre}} -->
        </b-nav-item-dropdown>
      </b-navbar-nav>

      </b-collapse>
    </b-navbar>

    <v-snackbar
      v-model="snackbar"
      :color="color"
      :timeout="timeout"
      :top="y === 'top'"
      :right="x === 'right'"
      :multi-line="mode === 'multi-line'"
      :vertical="mode === 'vertical'"
    >
      {{ text }}
      <v-btn dark flat @click="snackbar = false">
        Close
      </v-btn>
      </v-snackbar>
  </div>
  </template>

<script>
export default {
  data() {
    return {
      mostrar: false,
      mostrar2: false,
      cookie1: null,
      lista: "",
      busca: "",
      igual: "",
      valor: "",
      micookie: "",
      nombrecookie1: "idUser",
      usuario: [],
      idusuario:"",

      snackbar: false,
      color: "",
      mode: "",
      timeout: 6000,
      text: "",
      y: "top",
      x: "right"
    };
  },
  created() {
    this.cookie1 = document.cookie;
    // console.log(this.cookie1);
    this.traercookie();
  },
  methods: {
    traercookie() {
      this.lista = this.cookie1.split(";");
      for (var i = 0; i < this.lista.length; i++) {
        this.busca = this.lista[i].search(this.nombrecookie1);
        if (this.busca > -1) {
          this.micookie = this.lista[i];
        }
      }
      this.igual = this.cookie1.indexOf("=");
      this.valor = this.cookie1.substring(this.igual + 1);
      console.log(this.valor);
      if (this.valor != "") {
        let config = {
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          }
        };
        let params = new FormData();
        params.append("idusuario", this.valor);
        // params.append("password", this.password);
        axios
          .post(
            "https://pruebas1994.000webhostapp.com/api/api.php?action=buscaruser",
            params,
            config
          )
          .then(res => {
            this.usuario = res.data.usuario;
            this.snackbar = true;
            this.color = "cyan darken-2";
            this.text = "Bienvendio, " + this.usuario[0].nombre;
            if (this.usuario[0].id_tipo_usuario == 1) {
              this.mostrar2 = true;
            }
          });
        this.mostrar = true;
      }
    },
    cerrarsesion() {
      document.cookie =
        this.nombrecookie1 + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 UTC;";
      alert("adios");
      // location.reload(true);
      window.location = "/";
    },
    iniciarsesion(){
      this.$router.push({ name: "iniciarsesion" });
    }
  }
};
</script>

<style scoped>
/* NavItem */
.navbar {
  border-top-right-radius: 0px;
  border-top-left-radius: 0px;
  border-bottom-left-radius: 0px;
  border-bottom-right-radius: 0px;
  /* margin: auto; */
}
#navItems {
    color: white;
}
.nav-link {
  font-size: 15px;
  width: 100%;
  margin-right: 10px;
}

</style>
