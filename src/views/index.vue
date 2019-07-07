<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation >
            <v-text-field
              name='identificacion'
              v-model="identificacion"
              :counter="10"
              :rules="idRules"
              label="Identificación"
              required
              outline
              clearable
            ></v-text-field>

            <v-text-field
              name='password'
              v-model="password"
              :counter="8"
              :rules="passwordRules"
              :type="'password'"

              label="Contraseña"
              required
              outline
              clearable
            ></v-text-field>

            <v-btn color="success" @click="iniciosesion">
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
    usuario:[],
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
      else {
        this.iniciosesion();
      }
    },
    reset() {
      this.$refs.form.reset();
    },
    iniciosesion(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      };
      let params = new FormData();
      params.append("identificacion", this.identificacion);
      params.append("password", this.password);
      axios
        .post("http://localhost/api/api.php?action=login", params, config)
        .then(res => {
          this.usuario=res.data.usuario;

          if (
            this.identificacion == this.usuario[0].identificacion &&
            this.password == this.usuario[0].password
          ) {
            document.cookie =
                this.nombrecookie1 + "=" + this.usuario[0].idUsuarios + ";" + "path=/";
            // this.snackbar = true;
            // this.color='cyan darken-2';
            // this.text = "Bienvendio, " + this.students[0].nombre;
            // document.cookie="iduser = " + this.students[0].id + ";" + "path=/";
            this.ruta();
            // console.log(res.data.usuario);
          }
        });
    },
    ruta(){
      window.location = "/create/user";
    }

  }
};
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
</style>
