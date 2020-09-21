<template>
  <div>
    <social :socials="user.userPlatforms"></social>
  </div>
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