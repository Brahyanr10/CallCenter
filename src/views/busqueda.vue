<template >
  <div >
    <v-app >
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <h4>Listado Votantes</h4>
            <br>
            <h1>{{datos}}</h1>
            <h1>{{idbusqueda}}</h1>
            <v-data-table
              :headers="headers"
              :items="votantes"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.num_planilla }}</td>
                <td class="text-xs-left">{{ props.item.lider_referido }}</td>
                <td class="text-xs-left">{{ props.item.nombres }}</td>
                <td class="text-xs-left">{{ props.item.apellidos }}</td>
                <td class="text-xs-left">{{ props.item.identificacion }}</td>
                <td class="text-xs-left">{{ props.item.celular }}</td>
                <td class="text-xs-left">{{ props.item.direccion }}</td>
                <td class="text-xs-left">{{ props.item.nom_barrio }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.nombre }}</td>

                <router-link  class="text-xs-center" :to="{ name: 'editvotantes',
                                                            params: {id: props.item.iddatos} }">
                  editar
                </router-link>|
                <router-link  class="text-xs-center" :to="{ name: 'deletevotantes',
                                                            params: {id: props.item.iddatos} }">
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
      idbusqueda:this.$route.params.id,
      datos:this.$route.params.dato,
      votantes:[],
      headers: [
        {
          text: '# Planilla',
          align: 'left',
          sortable: false,
          value: ''
        },
        { text: 'Lider o referido', value: '' },
        { text: 'Nombres', value: '' },
        { text: 'Apellidos', value: '' },
        { text: 'Identificacion', value: '' },
        { text: 'Celular', value: '' },
        { text: 'Direccion', value: '' },
        { text: 'Barrio', value: '' },
        { text: 'E-mail', value: '' },
        { text: 'Puesto De Votacion', value: '' },
        {text: 'Accion', value: '' }
      ]
    }
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
      params.append("idbusqueda", this.idbusqueda);
      params.append("datos", this.datos);
      axios
        .post("http://localhost/api/api.php?action=busqueda", params, config)
        .then(res => {
            this.votantes = res.data.votantes;
            if (this.votantes.length == 0) {
              Swal.fire({
                type: 'error',
                title: 'Error...',
                text: 'No se encuentra informacion',
                })
            }
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
