<template >

</template>

<script>
export default {
  data() {
    return {
      idvotante: this.$route.params.id,
    }
  },
  created(){
    this.eliminarvotante();
  },
  methods:{
    eliminarvotante(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idvotante", this.idvotante);
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=eliminarvotante", params, config)
        .then(res => {
          this.$router.push({ name: "listvotantes" });
        });
    }
  }
}
</script>

<style lang="css" scoped>
</style>
