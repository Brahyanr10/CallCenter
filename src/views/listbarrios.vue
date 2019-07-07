<template >
  <div id="app">
    <v-app id="inspire">
      <v-flex xs12 sm8 offset-sm2>
        <v-card>
          <v-card-text>
            <v-data-table
              :headers="headers"
              :items="comuna"
              class="elevation-1"
            >
              <template v-slot:items="props">
                <td>{{ props.item.idcomuna }}</td>
                <td class="text-xs-right">{{ props.item.nom_comuna }}</td>
                <router-link  :to="{ name: 'editcomuna', params: {id: props.item.idcomuna} }">
                  editar
                </router-link>
              </template>
            </v-data-table>
          </V-card-text>
        </v-card>
      </V-flex>
    </v-app>
  </div>
</template>

<script>
export default {
  data () {
    return {
      comuna:[],
      headers: [
        {
          text: 'Id Barrio',
          align: 'left',
          sortable: false,
          value: 'name'
        },
        { text: 'Nombre Barrio', value: '' },
        { text: 'Nombre Comuna', value: '' },
        {text: 'Accion', value: '' }
      ]
    }
  },

}
</script>

<style lang="css" scoped>
</style>
