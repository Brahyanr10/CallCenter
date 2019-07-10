<template>
  <div id="app">
    <v-app id="inspire">
      <v-flex xs12 sm6 offset-sm3>
        <v-card>
          <v-card-text>
            <h4>Listado De Comunas</h4>
            <br />
            <v-data-table
              :headers="headers"
              :items="comuna"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.idcomuna }}</td>
                <td class="text-xs-left">{{ props.item.nom_comuna }}</td>
                <router-link
                  :to="{
                    name: 'editcomuna',
                    params: { id: props.item.idcomuna }
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
                  :to="{
                    name: 'deletecomuna',
                    params: { id: props.item.idcomuna }
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
      comuna: [],
      headers: [
        {
          text: "Id Comuna",
          align: "left",
          sortable: false,
          value: "name"
        },
        { text: "Número Comuna", value: "" },
        { text: "Acción", value: "" }
      ]
    };
  },
  created() {
    this.listarcomuna();
  },
  methods: {
    listarcomuna() {
      axios
        .post(
          "https://pruebas1994.000webhostapp.com/api/api.php?action=listarcomuna"
        )
        .then(res => {
          this.comuna = res.data.comuna;
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
