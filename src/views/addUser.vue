<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field
              name="identificacion"
              v-model="identificacion"
              :counter="10"
              :rules="idRules"
              label="Identificación"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="nombre"
              v-model="nombre"
              :rules="nameRules"
              label="Nombre"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="apellido"
              v-model="apellido"
              :rules="lastnameRules"
              label="Apellido"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="email"
              v-model="email"
              :rules="emailRules"
              label="E-mail"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="phone"
              v-model="phone"
              :rules="phoneRules"
              label="Telefono"
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name="password"
              v-model="password"
              :counter="8"
              :rules="passwordRules"
              :type="'password'"
              label="Contraseña"
              required
              outline
              clearable
            ></v-text-field>

          <!-- <v-select
            nome="tipo_usuario"
            v-model="select"
            :items="items"
            :rules="[v => !!v || 'Item es requerido']"
            label="Item"
            required
            outline
          ></v-select> -->

            <v-btn color="success" @click="agregarusuario">
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
        (id && id.length <= 10) ||
        "La identificación no puede superar los 10 caracteres"
    ],
    nameRules: [
      name => !!name || "Nombre es requerido",
      name =>
        (name && name.length <= 10) ||
        "El nombre no puede superar los 10 caracteres"
    ],
    lastnameRules: [
      lastname => !!lastname || "Apellido es requerido",
      lastname =>
        (lastname && lastname.length <= 10) ||
        "El apellido no puede superar los 10 caracteres"
    ],
    email: "",
    emailRules: [
      email => !!email || "E-mail es requerido",
      email => /.+@.+/.test(email) || "E-mail debe ser valido"
    ],
    // phoneRules: [
    //   phone => !!phone || "Telefono es requerido",
    //   phone =>
    //     (phone && phone.length <= 10) ||
    //     "El telefono no puede superar los 10 caracteres"
    // ],
    passwordRules: [
      password => !!password || "Contraseña es requerido",
      password =>
        (password && password.length <= 8) ||
        "La contraseña no puede superar los 8 caracteres"
    ],
    select: null,
    items: ["1", "2"]
  }),

  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        this.snackbar = true;
      }
    },
    reset() {
      this.$refs.form.reset();
    },
    agregarusuario(){
      console.log("entro");
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      };
      let params = new FormData();
      params.append("identificacion", this.identificacion);
      params.append("nombre", this.nombre);
      params.append("apellido", this.apellido);
      params.append("email", this.email);
      params.append("telefono", this.phone);
      params.append("password", this.password);
      axios
        .post(
          "http://localhost/api/api.php?action=create",params, config)
        .then(res => {

        });
    }
  }
};
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
</style>
