<template>
  <b-container  :fluid=true>
    <b-row no-gutters>
      <b-col cols="12">
        <b-jumbotron :user="user" fluid container-fluid>
          <ButtonSidebar></ButtonSidebar>
          <slot name="header" ></slot>
          <slot name="footer"></slot>
        </b-jumbotron>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import ButtonSidebar from "../Menu/ButtonSidebar";

export default {
  name: "Jumbotron",
  components: {ButtonSidebar},
  computed:{
    user: function(){
      if(this !== undefined){
        return this.$store.getters.users[this.$route.params.id]
      }
    }
  }
}
</script>

<style scoped>

</style>