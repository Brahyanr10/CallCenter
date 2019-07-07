<template >
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation >

            <h4>Agregar Comuna</h4>
            <br>

            <v-text-field
              name='comuna'
              v-model="comuna"
              :counter="10"
              :rules="idRules"
              label="Numero Comuna"
              required
              outline
              clearable
            ></v-text-field>

            <v-btn color="success" @click="agregarcomuna">
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


methods:{
    agregarcomuna(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("comuna", this.comuna);
      axios
        .post("http://localhost/api/api.php?action=agregarcomuna", params, config)
        .then(res => {
          this.$router.push({ name: "aggcomuna" });

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
