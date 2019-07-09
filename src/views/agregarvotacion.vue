<template >
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation >

            <h4>Agregar Punto De Votacion</h4>
            <br>

            <v-text-field
              name='punto_votacion'
              v-model="punto_votacion"
              :counter="20"
              :rules="idRules"
              label="Punto de Votacion"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name='direccion'
              v-model="direccion"
              :counter="20"
              :rules="idRules"
              label="Direccion"
              required
              outline
              clearable
            ></v-text-field>

            <v-select
              :items="barrios"
              item-text="nom_barrio"
              v-model="selected"
              item-value="idbarrio"
              label="Seleccione El barrio"
              bottom
              autocomplete
            ></v-select>


            <v-btn color="success" @click="agregarpunto">
              Validate
            </v-btn>

            <!-- <v-btn color="error" @click="reset">
              Reset Form
            </v-btn> -->
          </v-form>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {

  data: () => ({
    selected: { idbarrio: " " },
    barrios: [],
    puesto:[],
    punto_votacion:" ",
    direccion:" ",
    idRules: [
      id => !!id || "Numero de Comuna es requerido",
      id => (id && id.length <= 20) || "no puede superar los 10 caracteres"
    ]
  }),
  created(){
    this.traerbarrios();
  },
  methods:{
    traerbarrios() {
      axios
        .post("http://localhost/api/api.php?action=barrios")
        .then(res => {
          this.barrios = res.data.barrio;
          this.selected=this.barrios[0].idbarrio
          console.log(this.barrios);
        });
    },
    agregarpunto(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("punto", this.punto_votacion);
      params.append("direccion", this.direccion);
      params.append("idbarrio", this.selected[0]);
      axios
        .post(
          "http://localhost/api/api.php?action=buscarpuesto",
          params,
          config
        )
        .then(res => {
          this.puesto = res.data.puesto;
          if (this.puesto.length == 0) {
          axios
            .post(
              "http://localhost/api/api.php?action=agregarpunto",
              params,
              config
            )
            .then(res => {
              this.reset();
              Swal.fire({
                position: 'top',
                type: 'success',
                title: 'Puesto de votacion registrada con exito',
                showConfirmButton: false,
                timer: 1500
              })
            })
          }else {
            Swal.fire({
              type: 'error',
              title: 'Error...',
              text: 'Puesto ya esta registrada',

              })
          }
        });
    },
    reset() {
      this.$refs.form.reset();
    },
  }
}
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
</style>
