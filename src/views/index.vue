<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field
              v-model="identificacion"
              :counter="10"
              :rules="idRules"
              label="Identificación"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              v-model="password"
              :counter="8"
              :rules="passwordRules"
              :type="'password'"
              name="input-10-1"
              label="Contraseña"
              required
              outline
              clearable
            ></v-text-field>

            <v-btn color="success" @click="validate">
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
  data: () => ({
    identificacion: "",
    password: "",
    idRules: [
      v => !!v || "Identificacion es requerida",
      v =>
        (v && v.length <= 10) ||
        "La identificación no puede superar los 10 caracteres"
    ],
    passwordRules: [
      psw => !!psw || "Contraseña es requerida",
      psw =>
        (psw && psw.length <= 8) ||
        "La contraseña no puede superar los 8 caracteres"
    ]
  }),

  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        this.snackbar = true;
      }
    },
    reset() {
      this.$refs.form.reset();
    }
  }
};
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
</style>
