<template>
  <div>
    <v-app>
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <h4>Listado De Barrios</h4>
            <br />
            <v-form ref="form" v-model="valid" lazy-validation>
              <div class="search">
                <div class="infor">
                  <v-text-field
                    name="dato"
                    v-model="dato"
                    :counter="20"
                    :rules="[searc => !!searc || 'Digite el dato a buscar']"
                    label="Barrio a buscar"
                    required
                    outline
                    clearable
                  ></v-text-field>
                  <!-- <router-link
                    class="text-xs-center"
                    :to="{
                      name: 'busquedabarrio',
                      params: { dato: this.dato }
                    }"
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
              :items="barrio"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.idbarrio }}</td>
                <td class="text-xs-left">{{ props.item.nom_barrio }}</td>
                <td class="text-xs-left">{{ props.item.nom_comuna }}</td>
                <router-link
                  class="text-xs-center"
                  :to="{
                    name: 'editbarrio',
                    params: { id: props.item.idbarrio }
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
                    name: 'deletebarrio',
                    params: { id: props.item.idbarrio }
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
      barrio: [],
      headers: [
        {
          text: "Id Barrio",
          align: "left",
          sortable: false,
          value: ""
        },
        { text: "Nombre Barrio", value: "" },
        { text: "Número Comuna", value: "" },
        { text: "Acción", value: "" }
      ]
    };
  },
  created() {
    this.listarbarrio();
  },
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        // this.snackbar = true;
        // aca va el llamado del metodo
      } else {
      }
    },
    listarbarrio() {
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=listarbarrio"
        )
        .then(res => {
          this.barrio = res.data.barrio;
          console.log(this.barrio);
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
