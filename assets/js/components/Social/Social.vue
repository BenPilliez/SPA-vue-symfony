<template>
  <b-row>
    <b-col cols="12" lg="6" md="6" sm="6">
      <h6>Platformes de jeux</h6>
      <span v-for="game in gamePlatforms" :key="game.id" class="pl-2">
        <social-item :item="game"></social-item>
      </span>
    </b-col>

    <b-col cols="12" lg="6" md="6" sm="6">
      <h6>Réseaux sociaux</h6>
      <span v-for="social in socialPlatforms" :key="social.id" class="pl-2">
        <social-item :item="social"></social-item>
      </span>
    </b-col>

    <hr class="w-75 ">

  </b-row>
</template>

<script>
import SocialItem from "./SocialItem";

export default {
  name: "Social",
  props: {
    gamePlatforms: Array,
    socialPlatforms: Array
  },
  components: {SocialItem},

}
</script>

<style scoped>

</style>