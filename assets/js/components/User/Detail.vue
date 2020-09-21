<template>
  <b-container :fluid="true">
    <social :socials="user.userPlatforms"></social>
  </b-container>
</template>

<script>
import Social from "./Social";
export default {
  name: "Detail",
  components:{Social},
  props: {
    user: Object
  }
}
</script>

<style scoped>

</style>