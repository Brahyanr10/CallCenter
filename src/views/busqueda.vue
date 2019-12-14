<template >
  <div >
    <v-app >
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <h4>Listado Votantes</h4>
            <br>
            <!-- <h1>{{datos}}</h1>
            <h1>{{idbusqueda}}</h1> -->
            <v-data-table
              :headers="headers"
              :items="votantes"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.iddatos }}</td>
                <td>{{ props.item.num_planilla }}</td>
                <td class="text-xs-left">{{ props.item.lider_referido }}</td>
                <td class="text-xs-left">{{ props.item.nombres }}</td>
                <td class="text-xs-left">{{ props.item.apellidos }}</td>
                <td class="text-xs-left">{{ props.item.identificacion }}</td>
                <td class="text-xs-left">{{ props.item.celular }}</td>
                <td class="text-xs-left">{{ props.item.direccion }}</td>
                <td class="text-xs-left">{{ props.item.nom_barrio }}</td>
                <td class="text-xs-left">{{ props.item.nom_comuna }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.nombre }}</td>
                <td class="text-xs-left">{{ props.item.mesa }}</td>
                <td class="text-xs-left">{{ props.item.codigo_coor_lider }}</td>
                <td class="text-xs-left">{{ props.item.observacion }}</td>

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
          text: "Codigo",
          align: "left",
          sortable: false,
          value: ""
        },
        {
          text: "Planilla",
          align: "left",
          sortable: false,
          value: ""
        },
        { text: "Líder o referido", value: "" },
        { text: "Nombres", value: "" },
        { text: "Apellidos", value: "" },
        { text: "Identificación", value: "" },
        { text: "Celular", value: "" },
        { text: "Dirección", value: "" },
        { text: "Barrio", value: "" },
        { text: "Comuna", value: "" },
        { text: "E-mail", value: "" },
        { text: "Puesto De Votación", value: "" },
        { text: "Mesa De Votación", value: "" },
        { text: "Codigo lider O Coordinador", value: "" },
        { text: "Observacion", value: "" },
        { text: "Acción", value: "" }
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
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=busqueda", params, config)
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
