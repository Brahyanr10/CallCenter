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
                  name="planilla"
                  v-model="planilla"
                  :counter="10"
                  :rules="numPlaRules"
                  label="Numero Planilla"
                  required
                  outline
                  clearable
                ></v-text-field>

                 <v-select
                  :items="lider"
                  item-text="text"
                  v-model="selected3"
                  :rules="[ldr => !!ldr || 'Tipo de persona es requerido']"
                  item-value="value"
                  label="Seleccione el tipo de persona"
                  @change="mostrar()"
                  bottom
                  autocomplete
                  outline
                  clearable
                ></v-select>


                <v-select
                  :items="votantes"
                  item-text="iddatos"
                  v-model="selected4"
                  item-value="iddatos"
                  label="Codigo de Lider o Coordinador "
                  bottom
                  autocomplete
                  outline
                  clearable
                ></v-select>

                <v-text-field
                  name="nombres"
                  v-model="nombres"
                  :rules="[nam => !!nam || 'Nombre es requerido']"
                  label="Nombres"
                  required
                  outline
                  clearable
                ></v-text-field>

                <v-text-field
                  name="apellidos"
                  v-model="apellidos"
                  :rules="[apell => !!apell || 'Apellido es requerido']"
                  label="Apellidos"
                  required
                  outline
                  clearable
                ></v-text-field>

                <v-text-field
                  name="identificacion"
                  v-model="identificacion"
                  :counter="10"
                  :rules="identificacionRules"
                  label="Numero de Identificacion"
                  required
                  outline
                  clearable
                ></v-text-field>

                <v-text-field
                  name="celular"
                  v-model="celular"
                  :rules="[tel => !!tel || 'Telefono es requerido']"
                  label="Telefono"
                  outline
                  clearable
                ></v-text-field>

                <v-text-field
                  name="direccion"
                  v-model="direccion"
                  :counter="30"
                  :rules="direccionRules"
                  label="Direccion"

                  outline
                  clearable
                ></v-text-field>

                <v-select
                  :items="barrios"
                  item-text="nom_barrio"
                  v-model="selected1"
                  item-value="idbarrio"
                  label="Seleccione El barrio"
                  required
                  bottom
                  autocomplete
                  outline
                  clearable
                ></v-select>

                <v-text-field
                  name="email"
                  v-model="email"
                  :counter="30"
                  label="E-mail"
                  required
                  outline
                  clearable
                ></v-text-field>

                <v-select
                  :items="puestos"
                  item-text="nombre"
                  v-model="selected2"
                  item-value="idpuesto_votacion"
                  label="Seleccione el puesto de votacion"
                  bottom
                  autocomplete
                  outline
                  clearable
                ></v-select>

                <v-text-field
                  name="mesa"
                  v-model="mesa"
                  :counter="10"
                  label="Mesa de votacion"
                  required
                  outline
                  clearable
                ></v-text-field>

                <v-textarea
                outline
                name="observacion"
                v-model="observacion"
                label="Observacion"
                ></v-textarea>

                <v-btn
                  color="success"
                  @click="validate"
                  class="btn-Green btn--md"
                >
                  Registrar
                </v-btn>

                <v-btn color="error" @click="reset" class="btn-Red btn--md">
                  Resetear formulario
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
    selected1: { idbarrio: "" },
    selected2: { idpuesto_votacion: "" },
    selected3: { value: "" },
    selected4: {iddatos: ""},
    planilla: "",
    mostrar: false,
    lider_referido: "",
    nombres: "",
    apellidos: "",
    identificacion: "",
    celular: "",
    direccion: "",
    barrios: [],
    email: "",
    mesa:"",
    observacion:"",
    puesto: [],
    votante: [],
    votantes:[],

    lider: [
      { value: "", text: "" },
      { value: "Referido", text: "Referido" },
      { value: "Lider", text: "Lider" },
      { value: "Coordinador", text: "Coordinador" },
      { value: "Otro", text: "Otro" }
    ],

    numPlaRules: [
      numPla => !!numPla || "Numero de planilla es requerido",
      numPla =>
        (numPla && numPla.length <= 10) || "No puede superar los 10 caracteres"
    ],
    tipoPerRules: [
      id => !!id || "Numero de Comuna es requerido",
      id => (id && id.length <= 20) || "no puede superar los 10 caracteres"
    ],
    identificacionRules: [
      ident => !!ident || "Identificación es requerido",
      ident =>
        (ident && ident.length <= 10) || "No puede superar los 10 caracteres"
    ],
    // direccionRules: [
    //   direcc => !!direcc || "Dirección es requerido",
    //   direcc =>
    //     (direcc && direcc.length <= 30) || "No puede superar los 30 caracteres"
    // ]
  }),
  created() {
    this.traerdatos();
  },
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        // this.snackbar = true;
        this.agregarvotante();
      } else {
      }
    },
    mostrar(){
      console.log("entro");
      // if (this.selected3 == 'Lider' || this.selected3 == 'Coordinador' ) {
        this.mostrar=true;

      // }

    },
    traerdatos() {
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=barrios"
        )
        .then(res => {
          this.barrios = res.data.barrio;
          this.selected1 = this.barrios[0].idbarrio;
        });
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=puestos"
        )
        .then(res => {
          this.puestos = res.data.puesto;
          this.selected2 = this.puestos[0].idpuesto_votacion;
          this.selected3 = this.lider[0].value;
        });

        axios
          .post(
            "https://pruebas1994.000webhostapp.com/api/api.php?action=listarvotantes"
          )
          .then(res => {
            this.votantes = res.data.votantes;
            this.selected4=this.votantes[0].iddatos;
          });
    },
    agregarvotante() {
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("planilla", this.planilla);
      params.append("lider_referido", this.selected3);
      params.append("nombres", this.nombres);
      params.append("apellidos", this.apellidos);
      params.append("identificacion", this.identificacion);
      params.append("celular", this.celular);
      params.append("direccion", this.direccion);
      params.append("idbarrio", this.selected1);
      params.append("email", this.email);
      params.append("idpuesto", this.selected2);
      params.append("mesa", this.mesa);
      params.append("iddatos", this.selected4);
      params.append("observacion", this.observacion);
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=buscarvotante",
          params,
          config
        )
        .then(res => {
          this.votante = res.data.votante;
          if (this.votante.length == 0) {
            axios
              .post(
                "https://pruebas1994.000webhostapp.com/api/api.php?action=agregarvotante",
                params,
                config
              )
              .then(res => {
                Swal.fire({
                  position: "top",
                  type: "success",
                  title: "Votante registrad con exito",
                  showConfirmButton: false,
                  timer: 1500
                });
                this.reset();

              });
          } else {
            Swal.fire({
              type: "error",
              title: "Error...",
              text: "La identificacion ya esta registrada"
            });
          }
        });
    },
    reset() {
      this.$refs.form.reset();
      // location.reload();
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
.v-card__text {
    margin-bottom: 50px;
}
</style>
