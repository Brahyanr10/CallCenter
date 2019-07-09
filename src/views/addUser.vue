<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <div class="LoginDivider">
              <span class="LoginDivider-text">
                <span>Registro de usuario</span>
              </span>
              <div class="inputs">
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

                <v-btn
                  color="success"
                  @click="agregarusuario"
                  class="btn-Green btn--md"
                >
                  Registrar Usuario
                </v-btn>

                <v-btn color="error" @click="reset" class="btn-Red btn--md">
                  Resetear formulario
                </v-btn>
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
    usuario: [],
    identificacion: "",
    nombre: "",
    apellido: "",
    password: "",
    verificacion: 0,

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
    // lastnameRules: [
    //   lastname => !!lastname || "Apellido es requerido",
    //   lastname =>
    //     (lastname && lastname.length <= 10) ||
    //     "El apellido no puede superar los 10 caracteres"
    // ],
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
        // this.snackbar = true;
        // this.agregarusuario();
      }
    },
    reset() {
      this.$refs.form.reset();
    },
    agregarusuario() {
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
          "http://localhost/api/api.php?action=buscaridenti",
          params,
          config
        )
        .then(res => {
          this.usuarios = res.data.usuarios;
          if (this.usuarios.length == 0) {
            axios
              .post(
                "http://localhost/api/api.php?action=create",
                params,
                config
              )
              .then(res => {
                this.reset();
                Swal.fire({
                  position: "top",
                  type: "success",
                  title: "Usuario registrado con exito",
                  showConfirmButton: false,
                  timer: 1500
                });
              });
          } else {
            Swal.fire({
              type: "error",
              title: "Error...",
              text: "La identificacion ya esta registrada"
            });
          }
        });
    }
  }
};
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
