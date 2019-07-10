<template>
  <div>
    <v-app>
      <v-flex xs12 sm12 offset-sm0>
        <v-card>
          <v-card-text>
            <h4 style="margin-b">Listado Votantes</h4>
            <br />
            <v-form ref="form" v-model="valid" lazy-validation>
              <div class="search">
                <div class="filtro">
                  <div class="item">
                    <v-select
                      :items="items"
                      item-text="text"
                      v-model="selected"
                      item-value="id"
                      label="Buscar Por..."
                      bottom
                      autocomplete
                    ></v-select>
                  </div>
                  <div class="itembusqueda">
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
                    :to="{
                      name: 'busqueda',
                      params: { id: this.selected, dato: this.dato }
                    }"
                  > -->
                    <v-btn color="info" @click="validate">
                      Buscar
                      <v-icon>search</v-icon>
                    </v-btn>
                    <!-- </router-link> -->
                  </div>
                </div>
              </div>
            </v-form>

            <!-- <div class="mt-3">Selected: <strong>{{ selected }}</strong></div> -->

            <v-data-table
              :headers="headers"
              :items="votantes"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.num_planilla }}</td>
                <td class="text-xs-left">{{ props.item.lider_referido }}</td>
                <td class="text-xs-left">{{ props.item.nombres }}</td>
                <td class="text-xs-left">{{ props.item.apellidos }}</td>
                <td class="text-xs-left">{{ props.item.identificacion }}</td>
                <td class="text-xs-left">{{ props.item.celular }}</td>
                <td class="text-xs-left">{{ props.item.direccion }}</td>
                <td class="text-xs-left">{{ props.item.nom_barrio }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.nombre }}</td>

                <router-link
                  class="text-xs-center"
                  :to="{
                    name: 'editvotantes',
                    params: { id: props.item.iddatos }
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
                    name: 'deletevotantes',
                    params: { id: props.item.iddatos }
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
      selected: { id: " " },
      votantes: [],
      dato: "",
      items: [
        { id: 1, text: "planilla" },
        { id: 2, text: "Lider o referido" },
        { id: 3, text: "Nombres" },
        { id: 4, text: "Apellidos" },
        { id: 5, text: "Barrio" },
        { id: 6, text: "E-mail" },
        { id: 7, text: "Puesto De Votacion" }
      ],
      headers: [
        {
          text: "Planilla",
          align: "left",
          sortable: false,
          value: ""
        },
        { text: "Líder o referido", value: "" },
        { text: "Nombres", value: "" },
        { text: "Apellidos", value: "" },
        { text: "Identificación", value: "" },
        { text: "Celular", value: "" },
        { text: "Dirección", value: "" },
        { text: "Barrio", value: "" },
        { text: "E-mail", value: "" },
        { text: "Puesto De Votación", value: "" },
        { text: "Acción", value: "" }
      ]
    };
  },
  created() {
    this.listarvotantes();
  },
  busqueda() {
    this.$router.push({ name: "busquedabarrio", params: { dato: this.dato } });
  },
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        // this.snackbar = true;
        this.busqueda();
      } else {
      }
    },
    listarvotantes() {
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=listarvotantes"
        )
        .then(res => {
          this.votantes = res.data.votantes;
          // console.log(this.puesto);
        });
    }
  }
};
</script>

<style lang="css" scoped>
.v-card__text {
    margin-top: 50px;
}
.filtro {
    display: flex;
    width: 70%;
}
.item {
    margin-right: 60px;
    width: 40%
}
.itembusqueda {
    display: flex;
    width: 100%;
}
.info .v-icon {
    margin-left: 10px;
}
</style>
