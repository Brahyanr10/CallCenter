<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <div class="LoginDivider">
              <span class="LoginDivider-text">
                <span>Registrar Puesto De Votacion</span>
              </span>

              <div class="inputs">
                <v-text-field
                  name="punto_votacion"
                  v-model="punto_votacion"
                  :counter="60"
                  :rules="puntoVRules"
                  label="Punto de Votación"
                  required
                  outline
                  clearable
                ></v-text-field>

                <v-text-field
                  name="direccion"
                  v-model="direccion"
                  :counter="60"
                  :rules="direccionRules"
                  label="Dirección"
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
                  outline
                  clearable
                ></v-select>

                <v-btn
                  color="success"
                  @click="validate"
                  class="btn-Green btn--md"
                >
                  Registrar Puesto De Votacion
                </v-btn>
              </div>
            </div>
          </v-form>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data: () => ({
    selected: { idbarrio: "" },
    barrios: [],
    puesto: [],
    punto_votacion: "",
    direccion: "",
    puntoVRules: [
      puntV => !!puntV || "Puesto de votación es requerido",
      puntV =>
        (puntV && puntV.length <= 60) || "No puede superar los 60 caracteres"
    ],
    direccionRules: [
      direcc => !!direcc || "Dirección es requerido",
      direcc =>
        (direcc && direcc.length <= 60) || "No puede superar los 60 caracteres"
    ]
  }),
  created() {
    this.traerbarrios();
  },

  methods: {
    traerbarrios() {
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=barrios"
        )
        .then(res => {
          this.barrios = res.data.barrio;
          this.selected = this.barrios[0].idbarrio;
          console.log(this.barrios);
        });
    },
    validate() {
      if (this.$refs.form.validate()) {
        // this.snackbar = true;
        this.agregarpunto();
      } else {
      }
    },
    agregarpunto() {
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("punto", this.punto_votacion);
      params.append("direccion", this.direccion);
      params.append("idbarrio", this.selected);
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=buscarpuesto",
          params,
          config
        )
        .then(res => {
          this.puesto = res.data.puesto;
          if (this.puesto.length == 0) {
            axios
              .post(
                "https://pruebas1994.000webhostapp.com/api/api.php?action=agregarpunto",
                params,
                config
              )
              .then(res => {
                this.reset();
                Swal.fire({
                  position: "top",
                  type: "success",
                  title: "Puesto de votacion registrada con exito",
                  showConfirmButton: false,
                  timer: 1500
                });
              });
          } else {
            Swal.fire({
              type: "error",
              title: "Error...",
              text: "Puesto ya esta registrada"
            });
          }
        });
    },
    reset() {
      this.$refs.form.reset();
    }
  }
};
</script>

<style scoped>
.inputs {
    margin-top: 40px;
}
.v-card__text {
    margin-top: 50px;
}
.LoginDivider-text::before {
  content: "";
  position: absolute;
  top: 53%;
  right: 100%;
  width: 1000px;
  border-bottom: 1.5px solid #757575;
}
.LoginDivider-text:after {
  content: "";
  position: absolute;
  top: 53%;
  left: 100%;
  width: 5000px;
  border-bottom: 1.5px solid #757575;
}
.LoginDivider-text {
  position: relative;
  /* font-family: "cooper_hewittmedium"; */
  padding: 12px;
  font-weight: 600;
  color: #1c3643;
  font-size: 20px;
}
.LoginDivider {
  text-align: center;
  overflow: hidden;
  margin: 1rem auto;
  width: 94%;
}
.btn-Green,
.btn-green {
  background: -webkit-linear-gradient(
    right,
    #95ca3e 0%,
    #95ca3e 50%,
    #85c638 100%
  );
}
.btn,
.btn-Green,
.btn-green {
  background-color: #d3d3d3;
  border: none;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: "Lato", sans-serif;
  font-size: 13px;
  padding: 8px 0.8em 6px 0.8em;
  text-decoration: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -webkit-tap-highlight-color: transparent;
  -webkit-user-select: none;
  user-select: none;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  vertical-align: middle;
  white-space: nowrap;
  overflow: hidden;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  outline: 0;
}
.btn-Green {
  height: 45px;
  width: 100%;
}
.success {
    margin-left: 0px;
}
.inputs {
    margin-top: 40px;
}

.btn-Red,
.btn-green {
  background: -webkit-linear-gradient(
    right,
    #F44336 0%,
    #F44336 50%,
    #F44336 100%
  );
}
.btn,
.btn-Red,
.btn-green {
  background-color: #d3d3d3;
  border: none;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: "Lato", sans-serif;
  font-size: 13px;
  padding: 8px 0.8em 6px 0.8em;
  text-decoration: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -webkit-tap-highlight-color: transparent;
  -webkit-user-select: none;
  user-select: none;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  vertical-align: middle;
  white-space: nowrap;
  overflow: hidden;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  outline: 0;
}
.btn-Red {
  height: 45px;
  width: 100%;
}
.error {
    margin-left: 0px;
}
</style>
