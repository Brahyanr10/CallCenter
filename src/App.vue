<template>
  <div id="app">
    <v-app>
      <navBar />
      <v-content>
        <router-view></router-view>
      </v-content>
      <footers />
    </v-app>
  </div>
</template>

<script>
import navBar from "./components/navBar.vue";
import footers from "./components/footers.vue";


export default {
  name: "app",
  components: {
    navBar,
    footers,
  }
};
</script>

<style></style>
