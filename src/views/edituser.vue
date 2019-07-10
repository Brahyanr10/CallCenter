<template >
    <v-layout>
      <v-flex xs4 sm4 offset-sm4>
        <v-card>
          <v-card-text>
            <v-form ref="form" v-model="valid" lazy-validation >
              <div class="LoginDivider">
                <span class="LoginDivider-text">
                  <span>Editar Usuario</span>
                </span>
                <br>
                <br>
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
                name='nombre'
                v-model="nombre"
                :rules="nameRules"
                label="Nombre"
                required
                outline
                clearable
              ></v-text-field>

              <v-text-field
                name='apellido'
                v-model="apellido"
                :rules="lastnameRules"
                label="Apellido"
                required
                outline
                clearable
              ></v-text-field>

              <v-text-field
                name='correo'
                v-model="correo"
                :rules="emailRules"
                :type="'email'"
                label="Correo"
                required
                outline
                clearable
              ></v-text-field>

              <v-text-field
                name='telefono'
                v-model="telefono"
                :counter='10'
                :rules="phoneRules"
                label="Telefono"
                required
                outline
                clearable
              ></v-text-field>

              <v-text-field
                name='password'
                v-model="password"
                :rules="passwordRules"
                label="Password"
                required
                outline
                clearable
              ></v-text-field>

              <v-btn
                color="success"
                @click="updateusuario"
                class="btn-Green btn--md"
              >
                Editar Usuario
              </v-btn>


            </div>
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
      usuario:[],
      idusuario: this.$route.params.id,
      identificacion: "",
      password: "",
      nombre:"",
      apellido:"",
      correo:"",
      telefono:"",
      password:"",

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

    };
  },
  created(){
    this.traerusuarios();
  },

  methods:{
    traerusuarios(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idusuario", this.idusuario);
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=editusuario", params, config)
        .then(res => {
          this.usuario=res.data.usuarios;
          this.identificacion=this.usuario[0].identificacion;
          this.nombre=this.usuario[0].nombre;
          this.apellido=this.usuario[0].apellido;
          this.correo=this.usuario[0].Correo;
          this.telefono=this.usuario[0].telefono;
          this.password=this.usuario[0].password
      });
    },
    updateusuario(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idusuario", this.idusuario);
      params.append("identificacion", this.identificacion);
      params.append("nombre", this.nombre);
      params.append("apellido", this.apellido);
      params.append("correo", this.correo);
      params.append("telefono", this.telefono);
      params.append("password", this.password);
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=updateusuario", params, config)
        .then(res => {
          Swal.fire({
            position: 'top',
            type: 'success',
            title: 'Usuario actualizado con exito',
            showConfirmButton: false,
            timer: 1500
          })
          this.$router.push({ name: "listusers" });

        });
    }
  }
}
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
