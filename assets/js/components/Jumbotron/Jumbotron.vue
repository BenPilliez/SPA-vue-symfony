<template>
  <b-container :fluid=true>
    <b-row no-gutters>
      <b-col cols="12">
        <b-jumbotron fluid>
          <ButtonSidebar></ButtonSidebar>
          <slot name="header"></slot>
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
}
</script>

<style scoped>

</style>