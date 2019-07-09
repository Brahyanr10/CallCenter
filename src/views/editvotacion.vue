<template >
  <v-layout>
    <v-flex xs4 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation >
            <h4>Editar Punto de votacion</h4>
            <br>
            <v-text-field
              name='punto_votacion'
              v-model="punto_votacion"
              :counter="20"
              :rules="idRules"
              label="Nombre Barrio"
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
              label="Seleccione Un Barrio"
              bottom
              autocomplete
            ></v-select>

            <!-- <div class="mt-3">Selected: <strong>{{ selected }}</strong></div> -->

            <v-btn color="success" @click="updatepuesto">
              Validate
            </v-btn>

            <v-btn color="error" @click="reset">
              Reset Form
            </v-btn>
          </v-form>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      selected: { idbarrio: "" },
      punto_votacion:"",
      direccion:" ",
      idpuesto: this.$route.params.id,
      barrios:[],
      puesto:[],
    };
  },
  created(){
    this.traerpuesto();
  },

  methods:{
    traerpuesto(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idpuesto", this.idpuesto);
      axios
        .post("http://localhost/api/api.php?action=listarbarrio")
        .then(res => {
          this.barrios = res.data.barrio;
          console.log(this.comunas);
        });
        axios
          .post("http://localhost/api/api.php?action=editpuesto", params, config)
          .then(res => {
            this.puesto=res.data.puesto;
            this.punto_votacion=this.puesto[0].nombre;
            this.direccion=this.puesto[0].direccion
            this.selected=this.puesto[0].idbarrio
          });
    },
    updatepuesto(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idpuesto", this.idpuesto);
      params.append("nombre", this.punto_votacion);
      params.append("direccion", this.direccion);
      params.append("idbarrio", this.selected);
      axios
        .post("http://localhost/api/api.php?action=updatepuesto", params, config)
        .then(res => {
          Swal.fire({
            position: 'top',
            type: 'success',
            title: 'Usuario actualizado con exito',
            showConfirmButton: false,
            timer: 1500
          })
          this.$router.push({ name: "listvotacion" });

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
