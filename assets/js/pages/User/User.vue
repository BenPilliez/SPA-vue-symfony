<template>
  <section id="show">
    <b-container :fluid=true>
      <router-view :user="user"></router-view>
    </b-container>
  </section>
</template>

<script>
export default {
  name: "User",
  data(){
    return{
      user: this.loadUser(this,this.$route.params.id)
    }
  },
  watch: {
    $route() {
     this.user = this.loadUser(this, this.$route.params.id)
    }
  },
  methods: {
    loadUser: (vm, id) => {

      if (vm.$store.getters.users[id] !== undefined) {
        vm.user = vm.$store.getters.users[id];
      }
      vm.$store.dispatch('findBy', id)
          .then((resp) => {
            vm.user = vm.$store.getters.users[id]
          })
          .catch((err) => {
            console.error(err)
          })
    }
  }
}
</script>

<style scoped>

</style>