<template >
  <div id="app">
    <v-app id="inspire">
      <v-data-table
        :headers="headers"
        :items="users"
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td>{{ props.item.idUsuarios }}</td>
          <td class="text-xs-right">{{ props.item.nombre }}</td>
          <td class="text-xs-right">{{ props.item.apellido }}</td>
          <td class="text-xs-right">{{ props.item.Correo }}</td>
          <td class="text-xs-right">{{ props.item.telefono }}</td>
          <td class="text-xs-right">{{ props.item.password }}</td>
          <td class="text-xs-right">{{ props.item.id_tipo_usuario }}</td>
          <router-link  :to="{ name: 'editusers', params: {id: props.item.idUsuarios} }">
            <div  class="headline">editar</div>
          </router-link>
        </template>
      </v-data-table>
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
          align: 'left',
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
    }
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
</style>
