<template >
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>

            <h4>Editar votante</h4>
            <br>

            <v-text-field
              name="planilla"
              v-model="planilla"
              :counter="10"
              :rules="idRules"
              label="Numero Planilla"
              required
              outline
              clearable
            ></v-text-field>


            <v-text-field
              name="lider_referido"
              v-model="lider_referido"
              :rules="nameRules"
              label="Lider o referido"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="nombres"
              v-model="nombres"
              :rules="lastnameRules"
              label="Nombres"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="apellidos"
              v-model="apellidos"
              :rules="emailRules"
              label="Apellidos"
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
              :rules="phoneRules"
              label="Telefono"
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="direccion"
              v-model="direccion"
              :counter="30"
              :rules="passwordRules"
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
            ></v-select>

            <!-- <div class="mt-3">Selected: <strong>{{ selected1}}</strong></div>
            <div class="mt-3">Selected: <strong>{{ selected2 }}</strong></div> -->

            <v-btn color="success" @click="agregarvotante">
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

</template>

<script>
export default {
  data() {
    return {
      idvotante: this.$route.params.id,
      selected1: { idbarrio: " " },
      selected2: { idpuesto_votacion: " " },
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
      idRules: [
        id => !!id || "Numero de Comuna es requerido",
        id => (id && id.length <= 20) || "no puede superar los 10 caracteres"
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
      params.append("idvotante", this.idvotante);

      axios
        .post("http://localhost/api/api.php?action=barrios")
        .then(res => {
          this.barrios = res.data.barrio;
        });
        axios
          .post("http://localhost/api/api.php?action=puestos")
          .then(res => {
            this.puestos = res.data.puesto;

          });
          axios
            .post("http://localhost/api/api.php?action=editvotante", params, config)
            .then(res => {
              this.datos=res.data.datos;
              this.planilla=this.datos[0].num_planilla;
              this.lider_referido=this.datos[0].lider_referido;
              this.nombres=this.datos[0].nombres;
              this.apellidos=this.datos[0].apellidos
              this.identificacion=this.datos[0].identificacion;
              this.celular=this.datos[0].celular;
              this.direccion=this.datos[0].direccion;
              this.selected1=this.datos[0].idbarrio;
              this.email=this.datos[0].email;
              this.selected2=this.datos[0].id_puesto_votacion;

            });

    },
  }




}
</script>

<style lang="css" scoped>
</style>
