<template >


</template>

<script>
export default {

  data() {
    return {
      idpuesto: this.$route.params.id,
    }
  },
  created(){
    this.eliminarpuesto();
  },
  methods:{
    eliminarpuesto(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idpuesto", this.idpuesto);
      axios
        .post("https://pruebas1994.000webhostapp.com/api/api.php?action=eliminarpuesto", params, config)
        .then(res => {
          this.$router.push({ name: "listvotacion" });
        });
    }
  }
}
</script>

<style lang="css" scoped>
</style>
