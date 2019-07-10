<template>
  <div>
    <v-app>
      <v-flex xs12 sm10 offset-sm1>
        <v-card>
          <v-card-text>
            <h4>Listado Puestos De Votacion</h4>
            <br />
            <v-form ref="form" v-model="valid" lazy-validation>
              <div class="search">
                <div class="infor">
                  <v-text-field
                    name="dato"
                    v-model="dato"
                    :counter="20"
                    :rules="[searc => !!searc || 'Digite el dato a buscar']"
                    label="Dato a buscar"
                    required
                    outline
                    clearable
                  ></v-text-field>
                  <!-- <router-link
                  class="text-xs-center"
                  :to="{ name: 'busquedapuesto', params: { dato: this.dato } }"
                > -->
                  <v-btn color="info" @click="validate">
                    Buscar
                    <v-icon>search</v-icon>
                  </v-btn>
                  <!-- </router-link> -->
                </div>
              </div>
            </v-form>

            <v-data-table
              :headers="headers"
              :items="puesto"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.idpuesto_votacion }}</td>
                <td class="text-xs-left">{{ props.item.nombre }}</td>
                <td class="text-xs-left">{{ props.item.direccion }}</td>
                <td class="text-xs-left">{{ props.item.nom_barrio }}</td>
                <router-link
                  class="text-xs-center"
                  :to="{
                    name: 'editvotacion',
                    params: { id: props.item.idpuesto_votacion }
                  }"
                >
                  <v-tooltip left>
                    <template v-slot:activator="{ on }">
                      <v-btn dark v-on="on" color="cyan" fab small dark>
                        <v-icon>edit</v-icon>
                      </v-btn>
                    </template>
                    <span>Editar</span>
                  </v-tooltip>
                </router-link>
                |
                <router-link
                  class="text-xs-center"
                  :to="{
                    name: 'deletepuesto',
                    params: { id: props.item.idpuesto_votacion }
                  }"
                >
                  <v-tooltip right>
                    <template v-slot:activator="{ on }">
                      <v-btn dark v-on="on" color="warning" fab small dark>
                        <v-icon>delete</v-icon>
                      </v-btn>
                    </template>
                    <span>Eliminar</span>
                  </v-tooltip>
                </router-link>
              </template>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-app>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dato: "",
      puesto: [],
      headers: [
        {
          text: "Id Puesto De Votación",
          align: "left",
          sortable: false,
          value: "Id Puesto De Votación"
        },
        { text: "Nombre Votación", value: "nombre" },
        { text: "Dirección", value: "direccion" },
        { text: "Barrio", value: "barrio" },
        { text: "Acción", value: "" }
      ]
    };
  },
  created() {
    this.listarpuestos();
  },
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        // this.snackbar = true;
        // aca pone el meotodo de busqueda
      } else {
      }
    },
    listarpuestos() {
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=listarpuestos"
        )
        .then(res => {
          this.puesto = res.data.puesto;
          console.log(this.puesto);
        });
    }
  }
};
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
.search {
    display: flex;
}
.infor {
    display: flex;
    width: 60%;
}
.info .v-icon {
    margin-left: 10px;
}
</style>
