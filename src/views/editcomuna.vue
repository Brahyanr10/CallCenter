<template >
  <v-layout>
    <v-flex xs4 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation >
            <h4>Editar Comuna</h4>
            <br>
            <v-text-field
              name='num_comuna'
              v-model="num_comuna"
              :counter="10"
              :rules="idRules"
              label="Identificación"
              required
              outline
              clearable
            ></v-text-field>

            <v-btn color="success" @click="updatecomuna">
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
  data() {
    return {
      num_comuna:"",
      idcomuna: this.$route.params.id,
      comuna:[]
    };
  },
  created(){
    this.traercomuna();
  },
  methods:{
    traercomuna(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idcomuna", this.idcomuna);
      axios
        .post("http://localhost/api/api.php?action=editcomuna", params, config)
        .then(res => {
          this.comuna=res.data.comuna;
          this.num_comuna=this.comuna[0].nom_comuna;
        });
    },
    updatecomuna(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idcomuna", this.idcomuna);
      params.append("num_comuna", this.num_comuna);
      axios
        .post("http://localhost/api/api.php?action=updatecomuna", params, config)
        .then(res => {
          Swal.fire({
            position: 'top',
            type: 'success',
            title: 'Comuna actualizada con exito',
            showConfirmButton: false,
            timer: 1500
          })
          this.$router.push({ name: "listcomuna" });

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
