<template >
  <div >
    <v-app >
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <h4>Listado De  Barrios</h4>
            <br>
            <v-data-table
              :headers="headers"
              :items="barrio"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.idbarrio }}</td>
                <td class="text-xs-left">{{ props.item.nom_barrio }}</td>
                <td class="text-xs-left">{{ props.item.nom_comuna }}</td>
                <router-link  class="text-xs-center" :to="{ name: 'editbarrio',
                                                            params: {id: props.item.idbarrio} }">
                  editar
                </router-link>|
                <router-link  class="text-xs-center" :to="{ name: 'deletebarrio',
                                                            params: {id: props.item.idbarrio} }">
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
      barrio:[],
      datos:this.$route.params.dato,
      headers: [
        {
          text: 'Id Barrio',
          align: 'left',
          sortable: false,
          value: ''
        },
        { text: 'Nombre Barrio', value: '' },
        { text: 'Numero Comuna', value: '' },
        {text: 'Accion', value: '' }
      ]
    };
  },
  created(){
    this.traerdatos();
  },

  methods:{
    traerdatos(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("datos", this.datos);
      axios
        .post("http://localhost/api/api.php?action=busquedabarrio", params, config)
        .then(res => {
            this.barrio = res.data.barrio;
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
