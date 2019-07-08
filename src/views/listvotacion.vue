<template >
  <div >
    <v-app >
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <h4>Listado Puestos De Votacion</h4>
            <br>
            <v-data-table
              :headers="headers"
              :items="puesto"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.idpuesto_votacion }}</td>
                <td class="text-xs-left">{{ props.item.nombre }}</td>
                <td class="text-xs-left">{{ props.item.direccion }}</td>
                <td class="text-xs-left">{{ props.item.nom_barrio }}</td>
                <router-link  class="text-xs-center" :to="{ name: 'editbarrio',
                                                            params: {id: props.item.idbarrio} }">
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
      puesto:[],
      headers: [
        {
          text: 'Id Puesto De Votacion',
          align: 'left',
          sortable: false,
          value: ''
        },
        { text: 'Nombre Votacion', value: '' },
        { text: 'Direccion', value: '' },
        { text: 'Barrio', value: '' },
        {text: 'Accion', value: '' }
      ]
    };
  },
  created(){
    this.listarpuestos();
  },
  methods:{
    listarpuestos(){
      axios
        .post("http://localhost/api/api.php?action=listarpuestos")
        .then(res => {
          this.puesto = res.data.puesto;
          console.log(this.puesto);

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
