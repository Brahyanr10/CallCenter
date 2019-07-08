<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <h4>Agregar Barrio</h4>
            <br />

            <v-text-field
              name="barrio"
              v-model="barrio"
              :counter="20"
              :rules="idRules"
              label="Nombre Del Barrio"
              required
              outline
              clearable
            ></v-text-field>

            <v-select
              :items="comunas"
              item-text="nom_comuna"
              v-model="selected"
              item-value="idcomuna"
              label="Seleccione una comuna"
              bottom
              autocomplete
            ></v-select>
            <!-- <div class="mt-3">Selected: <strong>{{ selected }}</strong></div> -->

            <v-btn color="success" @click="agregarbarrio">
              Validate
            </v-btn>
          </v-form>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data: () => ({
    selected: { idcomuna:" " },
    comunas: [],
    barrio: "",
    verificacion: 0,
    idRules: [
      id => !!id || "Numero de Comuna es requerido",
      id => (id && id.length <= 20) || "no puede superar los 10 caracteres"
    ]
  }),
  created() {
    this.traercomunas();
  },
  methods: {
    reset() {
      this.$refs.form.reset();
    },
    agregarbarrio() {
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("barrio", this.barrio);
      params.append("comuna", this.selected);
      axios
        .post(
          "http://localhost/api/api.php?action=buscarbarrio",
          params,
          config
        )
        .then(res => {
          this.barrio = res.data.barrio;
          if (this.barrio.length == 0) {
            axios
              .post(
                "http://localhost/api/api.php?action=agregarbarrio",
                params,
                config
              )
              .then(res => {
                console.log(this.selected);
                this.reset();
                Swal.fire({
                  position: 'top',
                  type: 'success',
                  title: 'Comuna registrada con exito',
                  showConfirmButton: false,
                  timer: 1500
                })
              });
          }else {
            Swal.fire({
              type: 'error',
              title: 'Error...',
              text: 'La comuna ya esta registrada',

              })
          }
        });
    },
    traercomunas() {
      axios
        .post("http://localhost/api/api.php?action=listarcomuna")
        .then(res => {
          this.comunas = res.data.comuna;
          console.log(this.comunas);
        });
    }
  }
};
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
</style>
