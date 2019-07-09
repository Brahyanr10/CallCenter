<template >
  <div id="app">
    <v-app id="inspire">
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <h4>Listado De  Usuarios</h4>
            <br>
            <v-data-table
              :headers="headers"
              :items="users"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <!-- <td>{{ props.item.idUsuarios }}</td> -->
                <td class="text-xs-left">{{ props.item.identificacion }}</td>
                <td class="text-xs-left">{{ props.item.nombre }}</td>
                <td class="text-xs-left">{{ props.item.apellido }}</td>
                <td class="text-xs-left">{{ props.item.Correo }}</td>
                <td class="text-xs-left">{{ props.item.telefono }}</td>
                <td class="text-xs-left">{{ props.item.password }}</td>
                <router-link  :to="{ name: 'editusers', params: {id: props.item.idUsuarios} }">
                  editar
                </router-link>|
                <router-link  :to="{ name: 'eliminarusuario', params: {id: props.item.idUsuarios} }">
                  eliminar
                </router-link>
              </template>
            </v-data-table>
          </V-card-text>
        </v-card>
      </V-flex>
    </v-app>
  </div>
</template>

<script>
export default {
  data () {
    return {
      users:[],
      headers: [
        { text: 'Identificacion',
        align: 'center',
        sortable: false,
        value: 'identificación' },

        { text: 'Nombre', align: 'center', value: 'nombre' },
        { text: 'Apellido', value: 'apellido' },
        { text: 'Correo', value: 'Correo' },
        { text: 'Telefono', value: 'telefono' },
        { text: 'Password', value: 'Password' },
        {text: 'accion', value: '' }
      ]
    };
  },
  created(){
    this.listarusuarios();

  },
  methods: {
    listarusuarios(){
      axios
        .post("http://localhost/api/api.php?action=listarusuarios")
        .then(res => {
          this.users = res.data.usuarios;

        });
    }
  }
}
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
</style>
