<template >
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>

            <div class="LoginDivider">
              <span class="LoginDivider-text">
                <span>Editar Votante</span>
              </span>
              <br>
              <br>

            <v-text-field
              name="planilla"
              v-model="planilla"
              :rules="[plan => !!plan || 'Planilla es requerido']"
              label="Numero Planilla"
              required
              outline
              clearable
            ></v-text-field>

            <v-select
              :items="lider"
              item-text="text"
              v-model="selected3"
              :rules="[puesVot => !!puesVot || 'Puesto de votación es requerido']"
              item-value="value"
              label="Seleccione Lider y/ Coordinador"
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
              :rules="[name => !!name || 'Nombre es requerido']"
              label="Nombre"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="apellidos"
              v-model="apellidos"
              :rules="[lastname => !!lastname || 'Apellido es requerido']"
              label="Apellido"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="identificacion"
              v-model="identificacion"
              :counter="10"
              :rules="idRules"
              label="Numero de Identificacion"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="celular"
              v-model="celular"
              :rules="[phone => !!phone || 'Telefono es requerido']"
              label="Telefono"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="direccion"
              v-model="direccion"
              :counter="30"
              :rules="direccionRules"
              label="Direccion"
              required
              outline
              clearable
            ></v-text-field>

            <v-select
              :items="barrios"
              item-text="nom_barrio"
              v-model="selected1"
              item-value="idbarrio"
              label="Seleccione El barrio"
              bottom
              autocomplete
              outline
              clearable
            ></v-select>

            <v-text-field
              name="email"
              v-model="email"
              :counter="30"
              :rules="passwordRules"
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

            <!-- <div class="mt-3">Selected: <strong>{{ selected1}}</strong></div>
            <div class="mt-3">Selected: <strong>{{ selected2 }}</strong></div> -->

            <v-btn
              color="success"
              @click="validate"
              class="btn-Green btn--md"
            >
              Editar Votante
            </v-btn>
          </div>
          </v-form>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

</template>

<script>
export default {
  data() {
    return {
      idvotante: this.$route.params.id,
      selected1: { idbarrio: " " },
      selected2: { idpuesto_votacion: " " },
      selected3: { value: " " },
      selected4: {iddatos: ""},
      planilla:" ",
      lider_referido: " ",
      nombres: " ",
      apellidos: " ",
      identificacion: " ",
      celular: " ",
      direccion:" ",
      barrios: [],
      email: " ",
      puestos:[],
      datos:[],
      mesa:"",
      observacion:"",
      lider:[
        {value:"", text:""},
        {value:"Lider", text:"Lider"},
        {value:"Referido", text:"Referido"},
        {value:"Coordinador", text:"Coordinador"},
        {value:"Otro", text:"Otro"},

      ],
      idRules: [
        id => !!id || "Numero de identificación es requerido",
        id => (id && id.length <= 10) || "No puede superar los 10 caracteres"
      ],
      direccionRules: [
         dirr => !!dirr || "Dirección es requerido",
         dirr =>
           (dirr && dirr.length <= 60) ||
           "No puede superar los 60 caracteres"
       ],
    };
  },
  created(){
    this.traerdatos();
  },
  methods:{
    validate() {
  if (this.$refs.form.validate()) {
    // this.snackbar = true;
    this.updatevotantes();
  } else {
  }
},
    traerdatos(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idvotante", this.idvotante);

      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=barrios")
        .then(res => {
          this.barrios = res.data.barrio;
        });
        axios
          .post("https://pruebas1994.000webhostapp.com/api/api.php?action=puestos")
          .then(res => {
            this.puestos = res.data.puesto;

          });
          axios
            .post("https://pruebas1994.000webhostapp.com/api/api.php?action=editvotante", params, config)
            .then(res => {
              this.datos=res.data.datos;
              this.planilla=this.datos[0].num_planilla;
              this.selected3=this.datos[0].lider_referido;
              this.nombres=this.datos[0].nombres;
              this.apellidos=this.datos[0].apellidos
              this.identificacion=this.datos[0].identificacion;
              this.celular=this.datos[0].celular;
              this.direccion=this.datos[0].direccion;
              this.selected1=this.datos[0].idbarrio;
              this.email=this.datos[0].email;
              this.selected2=this.datos[0].id_puesto_votacion;
              this.selected4=this.datos[0].codigo_coor_lider;
              this.mesa=this.datos[0].mesa;
              this.observacion=this.datos[0].observacion;

            });
            axios
              .post(
                "https://pruebas1994.000webhostapp.com/api/api.php?action=listarvotantes"
              )
              .then(res => {
                this.votantes = res.data.votantes;

              });

    },
    updatevotantes(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("iddatos", this.idvotante);
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
      params.append("idcodigo", this.selected4);
      params.append("observacion", this.observacion);
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=updatevotantes", params, config)
        .then(res => {
          Swal.fire({
            position: 'top',
            type: 'success',
            title: 'Votante actualizado con exito',
            showConfirmButton: false,
            timer: 1500
          })
          this.$router.push({ name: "listvotantes" });

        })
    }
  }
}
</script>

<style lang="css" scoped>
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
