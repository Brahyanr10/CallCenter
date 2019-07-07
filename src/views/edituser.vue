<template >
    <v-layout>
      <v-flex xs4 sm4 offset-sm4>
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

              <v-btn color="success" @click="updateusuario">
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
        .post("http://localhost/api/api.php?action=editusuario", params, config)
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
        .post("http://localhost/api/api.php?action=updateusuario", params, config)
        .then(res => {
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
</style>
