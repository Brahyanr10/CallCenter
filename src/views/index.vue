<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <div class="LoginDivider">
              <span class="LoginDivider-text">
                <span>Inicio de sesión</span>
              </span>
              <div class="inputs">
                <v-text-field
                  name="identificacion"
                  v-model="identificacion"
                  :counter="10"
                  :rules="idRules"
                  label="Tu Identificación"
                  required
                  outline
                  clearable
                ></v-text-field>

                <v-text-field
                  name="password"
                  v-model="password"
                  :counter="20"
                  :rules="passwordRules"
                  :type="'password'"
                  label="Tu Contraseña"
                  required
                  outline
                  clearable
                ></v-text-field>
                <v-btn
                  color="success"
                  class="btn-Green btn--md"
                  @click="iniciosesion"
                >
                  <span>Inicia sesión</span>
                </v-btn>

                <!-- <v-btn color="error" @click="reset">
                  Reset Form
                </v-btn> -->
              </div>
            </div>
          </v-form>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data: () => ({
    nombrecookie1: "idUser",
    usuario: [],
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
        (psw && psw.length <= 20) ||
        "La contraseña no puede superar los 8 caracteres"
    ]
  }),

  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        this.snackbar = true;
      } else {
        this.iniciosesion();
      }
    },
    reset() {
      this.$refs.form.reset();
    },
    iniciosesion() {
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      };
      let params = new FormData();
      params.append("identificacion", this.identificacion);
      params.append("password", this.password);
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=login", params, config)
        .then(res => {
          this.usuario = res.data.usuario;
          if (
            this.identificacion == this.usuario[0].identificacion &&
            this.password == this.usuario[0].password
          ) {
            document.cookie =
              this.nombrecookie1 +
              "=" +
              this.usuario[0].idUsuarios +
              ";" +
              "path=/";
            this.ruta();
            // console.log(res.data.usuario);
          } else {
            Swal.fire({
              type: "error",
              title: "Error...",
              text: "Identificacion y/o contraseña incorrecta"
            });
          }
        });
    },
    ruta() {
      window.location = "/";
    }
  }
};
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
.inputs {
    margin-top: 40px;
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

.AccountFooter-create {
  margin-bottom: 16px;
}
/* @media only screen and (min-width: 64em) .AccountFooter {
  padding: 24px 32px;
}
@media only screen and (min-width: 48em) .AccountFooter {
  padding: 24px 42px;
} */
.btn--medium,
.btn--md {
  font-size: 1rem;
}
.v-btn.theme--light .v-btn__content span {
  font-size: 16px;
}
.success {
    margin-left: 0px;
}
</style>
