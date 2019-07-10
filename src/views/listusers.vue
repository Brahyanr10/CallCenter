<template>
  <div id="app">
    <v-app id="inspire">
      <v-flex xs12 sm10 offset-sm1>
        <v-card>
          <v-card-text>
            <h4>Listado De Usuarios</h4>
            <br />
            <v-data-table :headers="headers" :items="users" class="elevation-1">
              <template v-slot:items="props">
                <!-- <td>{{ props.item.idUsuarios }}</td> -->
                <td class="text-xs-left">{{ props.item.identificacion }}</td>
                <td class="text-xs-left">{{ props.item.nombre }}</td>
                <td class="text-xs-left">{{ props.item.apellido }}</td>
                <td class="text-xs-left">{{ props.item.Correo }}</td>
                <td class="text-xs-left">{{ props.item.telefono }}</td>
                <td class="text-xs-left">{{ props.item.password }}</td>
                <router-link
                  :to="{
                    name: 'editusers',
                    params: { id: props.item.idUsuarios }
                  }"
                >
                  <v-tooltip left>
                    <template v-slot:activator="{ on }">
                      <v-btn dark v-on="on" color="cyan" fab small dark>
                        <v-icon>edit</v-icon>
                      </v-btn>
                    </template>
                    <span>Editar</span>
                  </v-tooltip>
                </router-link>
                |
                <router-link
                  :to="{
                    name: 'eliminarusuario',
                    params: { id: props.item.idUsuarios }
                  }"
                >
                  <v-tooltip right>
                    <template v-slot:activator="{ on }">
                      <v-btn dark v-on="on" color="warning" fab small dark>
                        <v-icon>delete</v-icon>
                      </v-btn>
                    </template>
                    <span>Eliminar</span>
                  </v-tooltip>
                </router-link>
              </template>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-app>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      headers: [
        { text: "Identificación", sortable: false, value: "identificación" },

        { text: "Nombre", value: "nombre" },
        { text: "Apellido", value: "apellido" },
        { text: "Correo", value: "Correo" },
        { text: "Telefono", value: "telefono" },
        { text: "Password", value: "Password" },
        { text: "Acción", value: "" }
      ]
    };
  },
  created() {
    this.listarusuarios();
  },
  methods: {
    listarusuarios() {
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=listarusuarios"
        )
        .then(res => {
          this.users = res.data.usuarios;
        });
    }
  }
};
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
</style>
