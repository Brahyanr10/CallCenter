<template >
  <div id="app">
    <v-app id="inspire">
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <h4>Listado De  Barrios</h4>
            <br>
            <v-data-table
              :headers="headers"
              :items="users"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.idUsuarios }}</td>
                <td class="text-xs-left">{{ props.item.nombre }}</td>
                <td class="text-xs-left">{{ props.item.apellido }}</td>
                <td class="text-xs-left">{{ props.item.Correo }}</td>
                <td class="text-xs-left">{{ props.item.telefono }}</td>
                <td class="text-xs-left">{{ props.item.password }}</td>
                <td class="text-xs-left">{{ props.item.id_tipo_usuario }}</td>
                <router-link  :to="{ name: 'editusers', params: {id: props.item.idUsuarios} }">
                  editar
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
        {
          text: 'Id Usuario',
          align: 'center',
          sortable: false,
          value: 'name'
        },
        { text: 'Nombre', align: 'center', sortable: false, value: '' },
        { text: 'Apellido', value: '' },
        { text: 'Correo', value: '' },
        { text: 'Telefono', value: '' },
        { text: 'Password', value: '' },
        { text: 'tipo usuario', value: '' },
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
