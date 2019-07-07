<template >
  <v-layout>
    <v-flex xs4 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation >
            <h4>Editar barrio</h4>
            <br>
            <v-text-field
              name='num_barrio'
              v-model="num_barrio"
              :counter="10"
              :rules="idRules"
              label="Identificación"
              required
              outline
              clearable
            ></v-text-field>

            <v-select
              nome="nom_comuna"
              v-model="nom_comuna"
              :items="comunas.num_comunax"
              :rules="[v => !!v || 'Item es requerido']"
              label="Item"
              required
              outline
            ></v-select>

            <v-btn color="success" @click="">
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
      num_barrio:"",
      nom_comuna:null,
      idbarrio: this.$route.params.id,
      barrio:[],
      comunas:[],
      comunaitems:[]
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
        .post("http://localhost/api/api.php?action=editbarrio", params, config)
        .then(res => {
          this.barrio=res.data.barrio;
          this.num_barrio=this.barrio[0].nom_barrio;
        });
        axios
          .post("http://localhost/api/api.php?action=listarcomuna", params, config)
          .then(res => {
            this.comunas=res.data.comuna;
            this.comunaitems=this.comunas;
            console.log(this.comunas);
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
      params.append("idbarrio", this.idcomuna);
      params.append("num_comuna", this.num_comuna);
      axios
        .post("http://localhost/api/api.php?action=updatecomuna", params, config)
        .then(res => {
          this.$router.push({ name: "listcomuna" });

        });

    }
  }
}
</script>

<style lang="css" scoped>
</style>
