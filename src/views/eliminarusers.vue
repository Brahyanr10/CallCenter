<template >

</template>

<script>
export default {
  data() {
    return {
      idusuario: this.$route.params.id,
    }
  },
  created(){
    this.eliminarusuario();
  },
  methods:{
    eliminarusuario(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idusuario", this.idusuario);
      axios
        .post("http://localhost/api/api.php?action=eliminarusuario", params, config)
        .then(res => {
          this.$router.push({ name: "listusers" });
        });
    }
  }
}
</script>

<style lang="css" scoped>
</style>
