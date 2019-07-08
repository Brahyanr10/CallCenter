<template >

</template>

<script>
export default {
  data() {
    return {
      idbarrio: this.$route.params.id,
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
      params.append("idbarrio", this.idbarrio);
      axios
        .post("http://localhost/api/api.php?action=eliminarbarrio", params, config)
        .then(res => {
          this.$router.push({ name: "listbarrio" });
        });
    }
  }
}
</script>

<style lang="css" scoped>
</style>
