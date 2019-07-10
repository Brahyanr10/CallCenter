<template >
  <v-layout>
    <v-flex xs4 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation >
            <div class="LoginDivider">
              <span class="LoginDivider-text">
                <span>Editar Comuna</span>
              </span>
              <br>
              <br>
            <v-text-field
              name='nom_barrio'
              v-model="nom_barrio"
              :counter="20"
              :rules="idRules"
              label="Nombre Barrio"
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

            <v-btn
              color="success"
              @click="updatebarrio"
              class="btn-Green btn--md"
            >
              Editar Barrio
            </v-btn>


            </div>
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
  data() {
    return {
      selected: { idcomuna: "" },
      nom_barrio:"",
      idbarrio: this.$route.params.id,
      comunas:[],
    };
  },
  created(){
    this.traerbarrio();
  },
  methods:{
    traerbarrio(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idbarrio", this.idbarrio);
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=listarcomuna")
        .then(res => {
          this.comunas = res.data.comuna;
          console.log(this.comunas);
        });

      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=editbarrio", params, config)
        .then(res => {
          this.barrio=res.data.barrio;
          this.nom_barrio=this.barrio[0].nom_barrio;
          this.selected=this.barrio[0].idcomuna
        });

    },
    updatebarrio(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idbarrio", this.idbarrio);
      params.append("nombre", this.nom_barrio);
      params.append("idcomuna", this.selected);
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=updatebarrio", params, config)
        .then(res => {
          Swal.fire({
            position: 'top',
            type: 'success',
            title: 'Barrio actualizado con exito',
            showConfirmButton: false,
            timer: 1500
          })
          this.$router.push({ name: "listbarrio" });
        });
    },
    traercomunas() {
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=listarcomuna")
        .then(res => {
          this.comunas = res.data.comuna;
          console.log(this.comunas);
        });
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
