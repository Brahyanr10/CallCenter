<template >

</template>

<script>
export default {
  data() {
    return {
      idcomuna: this.$route.params.id,
    }
  },
  created(){
    this.eliminarcomuna();
  },
  methods:{
    eliminarcomuna(){
      let config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Content-Type": "multipart/form-data"
        }
      };
      let params = new FormData();
      params.append("idcomuna", this.idcomuna);
      axios
        .post("http://localhost/api/api.php?action=eliminarcomuna", params, config)
        .then(res => {
          this.$router.push({ name: "listcomuna" });
        });
    }
  }
}
</script>

<style lang="css" scoped>
</style>
