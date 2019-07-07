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
              v-model="nombre"
              :counter="10"
              :rules="nameRules"
              label="Nombre"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              v-model="apellido"
              :counter="10"
              :rules="lastnameRules"
              label="Apellido"
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

            <v-select
              v-model="select"
              :items="items"
              :rules="[v => !!v || 'Item es requerido']"
              label="Item"
              required
              outline
            ></v-select>

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
    nombre: "",
    apellido: "",
    password: "",

    idRules: [
      id => !!id || "Identificacion es requerido",
      id =>
        (id && v.length <= 10) ||
        "La identificación no puede superar los 10 caracteres"
    ],
    nameRules: [
      name => !!name || "Nombre es requerido",
      name =>
        (name && v.length <= 10) ||
        "El nombre no puede superar los 10 caracteres"
    ],
    lastnameRules: [
      lastname => !!lastname || "Apellido es requerido",
      lastname =>
        (lastname && v.length <= 10) ||
        "El apellido no puede superar los 10 caracteres"
    ],
    passwordRules: [
      psw => !!psw || "Contraseña es requerido",
      psw =>
        (psw && psw.length <= 8) ||
        "La contraseña no puede superar los 8 caracteres"
    ],
    select: null,
    items: ["Item 1", "Item 2", "Item 3", "Item 4"]
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
