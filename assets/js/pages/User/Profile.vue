<template>
  <b-row v-if="user !== undefined">
    <Tabs :user="user"></Tabs>
  </b-row>
</template>

<script>
import Tabs from "../../components/Tabs/Tabs";

export default {
  name: "Profile",
  components: {Tabs},
  props: {
    user: Object
  },
}
</script>

<style scoped>

</style>