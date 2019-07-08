<template >
  <div id="app">
    <v-app id="inspire">
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <h4>Listado De  Comunas</h4>
            <br>
            <v-data-table
              :headers="headers"
              :items="comuna"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.idcomuna }}</td>
                <td class="text-xs-left">{{ props.item.nom_comuna }}</td>
                <router-link  :to="{ name: 'editcomuna', params: {id: props.item.idcomuna} }">
                  editar
                </router-link>|
                <router-link  :to="{ name: 'deletecomuna', params: {id: props.item.idcomuna} }">
                  Eliminar
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
      comuna:[],
      headers: [
        {
          text: 'Id Comuna',
          align: 'left',
          sortable: false,
          value: 'name'
        },
        { text: 'Numero Comuna', value: '' },
        {text: 'accion', value: '' }
      ]
    };
  },
  created(){
    this.listarcomuna();
  },
  methods:{
    listarcomuna(){
      axios
        .post("http://localhost/api/api.php?action=listarcomuna")
        .then(res => {
          this.comuna = res.data.comuna;

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
