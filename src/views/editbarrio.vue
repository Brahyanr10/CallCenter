<template >
  <v-layout>
    <v-flex xs4 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation >
            <h4>Editar barrio</h4>
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

            <v-btn color="success" @click="updatebarrio">
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
        .post("http://localhost/api/api.php?action=listarcomuna")
        .then(res => {
          this.comunas = res.data.comuna;
          console.log(this.comunas);
        });

      axios
        .post("http://localhost/api/api.php?action=editbarrio", params, config)
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
        .post("http://localhost/api/api.php?action=updatebarrio", params, config)
        .then(res => {


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
}
</script>

<style lang="css" scoped>
</style>
