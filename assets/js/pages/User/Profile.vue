<template>
  <div v-if="user !== undefined">
  </div>
</template>

<script>
import Jumbotron from "../../components/Jumbotron/Jumbotron";

export default {
  name: "Profile",
  components: {Jumbotron},
  props: {
    user: Object
  },
}
</script>

<style scoped>

</style>